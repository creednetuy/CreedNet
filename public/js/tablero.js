// =============================================
// CONFIGURACIÓN Y DATOS MAESTROS
// =============================================

const tablero = document.getElementById('tablero');
const partidaId = tablero.dataset.partidaId;
const estadoGuardado = tablero.dataset.estado ? JSON.parse(tablero.dataset.estado) : null;
const fichasMaestras = tablero.dataset.fichas ? JSON.parse(tablero.dataset.fichas) : {};
const recintosMaestros = tablero.dataset.recintos ? JSON.parse(tablero.dataset.recintos) : {};

let gameState = {
    jugadorActual: 1,
    recintos: {
        recinto1: { fichas: [], recintoId: 1 },
        recinto2: { fichas: [], recintoId: 2 },
        recinto3: { fichas: [], recintoId: 3 },
        recinto4: { fichas: [], recintoId: 4 },
        recinto5: { fichas: [], recintoId: 5 },
        recinto6: { fichas: [], recintoId: 6 },
        recinto7: { fichas: [], recintoId: 7 }
    },
    movimientos: []
};

// =============================================
// FUNCIONES DE CONVERSIÓN
// =============================================

function getFichaIdPorTipo(tipoFicha) {
    const ficha = Object.values(fichasMaestras).find(f => f.tipo_ficha === tipoFicha);
    return ficha ? ficha.idficha : null;
}

function getTipoFichaPorId(fichaId) {
    const ficha = fichasMaestras[fichaId];
    return ficha ? ficha.tipo_ficha : null;
}

function getReglasRecinto(nombreRecinto) {
    const recinto = recintosMaestros[nombreRecinto];
    return recinto ? recinto.reglas : 'Sin reglas definidas';
}

// =============================================
// FUNCIONES DE DRAG & DROP
// =============================================

function dragStart(event) {
    const fichaTipo = event.target.getAttribute('data-type');
    const fichaId = getFichaIdPorTipo(fichaTipo);
    
    event.dataTransfer.setData("text/plain", event.target.id);
    event.dataTransfer.setData("ficha-tipo", fichaTipo);
    event.dataTransfer.setData("ficha-id", fichaId);
    event.dataTransfer.setData("text/type", "draggable-item");
}

function dragOver(event) {
    event.preventDefault();
    if (event.target.classList.contains('drop-zone')) {
        event.target.style.backgroundColor = 'rgba(255,255,255,0.5)';
    }
}

function drop(event) {
    event.preventDefault();
    const data = event.dataTransfer.getData("text/plain");
    const fichaTipo = event.dataTransfer.getData("ficha-tipo");
    const fichaId = event.dataTransfer.getData("ficha-id");
    const targetId = event.target.id;

    if (event.dataTransfer.getData("text/type") === "draggable-item" && targetId.startsWith('recinto')) {
        const original = document.getElementById(data);
        let valid = false;
        
        const clone = original.cloneNode(true);
        clone.id = `ficha-${fichaId}-clone-${Date.now()}`;
        clone.setAttribute('data-ficha-id', fichaId);
        clone.draggable = true;
        clone.addEventListener('dragstart', dragStart);

        const recintoActual = gameState.recintos[targetId];
        
        switch(targetId) {
            case 'recinto1':
                valid = recintoActual.fichas.length === 0 || 
                       recintoActual.fichas.every(f => f.tipo === fichaTipo);
                break;
            case 'recinto2':
                valid = recintoActual.fichas.length < 3;
                break;
            case 'recinto3':
                valid = true;
                break;
            case 'recinto4':
                valid = recintoActual.fichas.every(f => f.tipo !== fichaTipo);
                break;
            case 'recinto5':
                valid = recintoActual.fichas.length === 0;
                break;
            case 'recinto6':
                valid = true;
                break;
            case 'recinto7':
                valid = recintoActual.fichas.length === 0;
                break;
        }

        if (valid) {
            event.target.appendChild(clone);
            event.target.style.backgroundColor = 'rgba(255,255,255,0.3)';
            
            gameState.recintos[targetId].fichas.push({
                id: fichaId,
                tipo: fichaTipo,
                jugador: gameState.jugadorActual
            });
            
            gameState.movimientos.push({
                tipo: 'colocar',
                fichaId: fichaId,
                fichaTipo: fichaTipo,
                recinto: targetId,
                jugador: gameState.jugadorActual,
                timestamp: new Date().toISOString()
            });
        } else {
            const recinto = recintosMaestros[targetId];
            alert(`No se puede agregar a ${recinto?.nombre_mostrado || targetId}. ${recinto?.reglas || 'Revisa las reglas.'}`);
        }
    } else {
        alert("Solo puedes soltar fichas en recintos válidos.");
    }
}

function dragLeave(event) {
    if (event.target.classList.contains('drop-zone')) {
        event.target.style.backgroundColor = 'rgba(255,255,255,0.3)';
    }
}

// =============================================
// SISTEMA DE PUNTUACIÓN 
// =============================================

function calcularPuntuacion() {
    let totalPuntos = 0;
    const estado = gameState.recintos;

    if (estado.recinto1.fichas.length > 0 && 
        estado.recinto1.fichas.every(f => f.tipo === estado.recinto1.fichas[0].tipo)) {
        totalPuntos += [0,2,4,8,12,18,24][estado.recinto1.fichas.length] || 0;
    }

    if (estado.recinto2.fichas.length === 3) totalPuntos += 7;

    const pairs = {};
    estado.recinto3.fichas.forEach(f => {
        pairs[f.tipo] = (pairs[f.tipo] || 0) + 1;
    });
    for (let tipo in pairs) {
        totalPuntos += Math.floor(pairs[tipo] / 2) * 5;
    }

    const tiposUnicos = new Set(estado.recinto4.fichas.map(f => f.tipo));
    if (tiposUnicos.size > 0 && tiposUnicos.size === estado.recinto4.fichas.length) {
        totalPuntos += [0,1,3,6,10,15,21][tiposUnicos.size] || 0;
    }

    if (estado.recinto5.fichas.length === 1 && window.zona5Mayoría) {
        totalPuntos += 7;
    }

    totalPuntos += estado.recinto6.fichas.length;

    if (estado.recinto7.fichas.length === 1) {
        const tipo7 = estado.recinto7.fichas[0].tipo;
        let count = 0;
        for (const recintoKey in estado) {
            count += estado[recintoKey].fichas.filter(f => f.tipo === tipo7).length;
        }
        if (count === 1) totalPuntos += 7;
    }

    return totalPuntos;
}

// =============================================
// CARGA DE ESTADO GUARDADO
// =============================================

function cargarEstadoGuardado() {
    if (!estadoGuardado) return;

    document.querySelectorAll('.drop-zone').forEach(zone => {
        zone.innerHTML = '';
    });

    for (const recintoKey in estadoGuardado) {
        const zoneElement = document.getElementById(recintoKey);
        if (!zoneElement) continue;

        const recintoData = estadoGuardado[recintoKey];
        
        if (recintoData && Array.isArray(recintoData.fichas)) {
            gameState.recintos[recintoKey].fichas = recintoData.fichas.map(ficha => ({
                id: ficha.id,
                tipo: ficha.tipo,
                jugador: ficha.jugador
            }));

            recintoData.fichas.forEach(fichaObj => {
                const ficha = document.createElement("div");
                ficha.classList.add("ficha", `ficha-${fichaObj.tipo}`);
                ficha.setAttribute("data-type", fichaObj.tipo);
                ficha.setAttribute("data-ficha-id", fichaObj.id);
                ficha.draggable = true;
                ficha.addEventListener("dragstart", dragStart);
                zoneElement.appendChild(ficha);
            });
        }
        else if (Array.isArray(recintoData)) {
            gameState.recintos[recintoKey].fichas = recintoData.map(tipo => ({
                id: getFichaIdPorTipo(tipo),
                tipo: tipo,
                jugador: 1
            }));

            recintoData.forEach(tipo => {
                const ficha = document.createElement("div");
                ficha.classList.add("ficha", `ficha-${tipo}`);
                ficha.setAttribute("data-type", tipo);
                ficha.setAttribute("data-ficha-id", getFichaIdPorTipo(tipo));
                ficha.draggable = true;
                ficha.addEventListener("dragstart", dragStart);
                zoneElement.appendChild(ficha);
            });
        }
    }
}

// =============================================
// INICIALIZACIÓN 
// =============================================
document.addEventListener('DOMContentLoaded', function() {
    cargarEstadoGuardado();
    
    document.querySelectorAll('.drop-zone').forEach(z => {
        z.addEventListener('dragleave', dragLeave);
    });

    const finalizarButton = document.getElementById('finalizarPartidaBtn');
    if (finalizarButton) {
        finalizarButton.addEventListener('click', async function() {
            const totalPuntos = calcularPuntuacion();
            document.getElementById('puntajeTotal').innerHTML = `Puntaje total: ${totalPuntos} puntos`;

            try {
                const response = await fetch('/guardar-partida', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        idpartida: partidaId,
                        puntajetotal: totalPuntos,
                        estado_tablero: gameState.recintos,
                        movimientos: gameState.movimientos,
                        jugador: gameState.jugadorActual
                    })
                });

                if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
                
                const result = await response.json();
                if (result.success) {
                    alert('Partida finalizada. Puntaje: ' + totalPuntos);
                    window.location.href = '/gestionar-partidas';
                } else {
                    alert('Error: ' + result.message);
                }
            } catch(error) {
                alert('Error: ' + error.message);
            }
        });
    }

    const diceButtons = document.querySelectorAll('.dice-btn');
    const resultDiv = document.getElementById('diceResult');
    let dadoSeleccionado = null;

    const restricciones = {
        1: ['recinto1', 'recinto2', 'recinto3'],
        2: ['recinto4', 'recinto5', 'recinto7'],
        3: ['recinto6'],
        4: ['recinto1', 'recinto2', 'recinto5'],
        5: ['recinto4', 'recinto7', 'recinto3'],
        6: ['recinto1', 'recinto2', 'recinto3', 'recinto4', 'recinto5', 'recinto7']
    };

    if (diceButtons.length > 0 && resultDiv) {
        diceButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const valor = parseInt(this.dataset.value);

                if (dadoSeleccionado === valor) {
                    dadoSeleccionado = null;
                    resultDiv.textContent = "Seleccione una cara";
                    diceButtons.forEach(b => {
                        b.classList.remove('active', 'btn-primary');
                        b.classList.add('btn-outline-primary');
                    });
                    document.querySelectorAll('.drop-zone').forEach(zone => {
                        zone.style.opacity = '1';
                        zone.style.pointerEvents = 'auto';
                        zone.style.backgroundColor = '';
                    });
                    return;
                }

                dadoSeleccionado = valor;
                diceButtons.forEach(b => {
                    b.classList.remove('active', 'btn-primary');
                    b.classList.add('btn-outline-primary');
                });
                this.classList.remove('btn-outline-primary');
                this.classList.add('btn-primary', 'active');
                resultDiv.textContent = `Has seleccionado la cara ${dadoSeleccionado}`;

                const bloqueadas = restricciones[dadoSeleccionado] || [];
                document.querySelectorAll('.drop-zone').forEach(zone => {
                    if (bloqueadas.includes(zone.id)) {
                        zone.style.opacity = '0.6';
                        zone.style.pointerEvents = 'none';
                        zone.style.backgroundColor = 'rgba(255, 0, 0, 0.4)';
                    } else {
                        zone.style.opacity = '1';
                        zone.style.pointerEvents = 'auto';
                        zone.style.backgroundColor = '';
                    }
                });
            });
        });
    }

    window.zona5Mayoría = false;
    const btnSi = document.getElementById('mayoriaSi');
    const btnNo = document.getElementById('mayoriaNo');

    if (btnSi && btnNo) {
        btnSi.addEventListener('click', function() {
            window.zona5Mayoría = true;
            btnSi.classList.add('btn-success');
            btnSi.classList.remove('btn-outline-success');
            btnNo.classList.add('btn-outline-danger');
            btnNo.classList.remove('btn-danger');
        });

        btnNo.addEventListener('click', function() {
            window.zona5Mayoría = false;
            btnNo.classList.add('btn-danger');
            btnNo.classList.remove('btn-outline-danger');
            btnSi.classList.add('btn-outline-success');
            btnSi.classList.remove('btn-success');
        });
    }
});