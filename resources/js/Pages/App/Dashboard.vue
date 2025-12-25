<template>
    <div class="main-scroll-area custom-scroll">
        <div class="container">
            <div class="welcome-banner">
                <h1 class="welcome-title">Bonjour, {{ firstname }} 👋</h1>
                <p class="welcome-subtitle">Voici ce qui se passe aujourd'hui à Gifrane SA.</p>
            </div>

            <div class="dashboard-grid">
                <div class="widget-card" style="grid-row: span 2;">
                    <div class="widget-header">
                        <div class="widget-title">Agenda du jour</div>
                        <div class="widget-action">Voir tout</div>
                    </div>

                    <div class="agenda-list">
                        <div class="agenda-item">
                            <div class="agenda-time">09:30</div>

                            <div class="agenda-details">
                                <div class="agenda-title">Point Synchro Équipe</div>
                                <div class="agenda-meta">Visio (Zoom)</div>
                            </div>
                        </div>

                        <div class="agenda-item">
                            <div class="agenda-time">11:00</div>

                            <div class="agenda-details">
                                <div class="agenda-title">Revue de production</div>
                                <div class="agenda-meta">Salle Opale</div>
                            </div>
                        </div>

                        <div class="agenda-item">
                            <div class="agenda-time">14:00</div>

                            <div class="agenda-details">
                                <div class="agenda-title">Déjeuner Client</div>
                                <div class="agenda-meta">Extérieur</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget-card">
                    <div class="widget-header">
                        <div class="widget-title">Mes Tâches</div>
                    </div>

                    <div class="task-list">
                        <div class="task-item">
                            <input type="checkbox" class="task-check">
                            <div class="task-content">Relancer fournisseur AX-90</div>
                            <span class="task-tag tag-urgent">Urgent</span>
                        </div>

                        <div class="task-item">
                            <input type="checkbox" class="task-check">
                            <div class="task-content">Préparer slides Comex</div>
                            <span class="task-tag tag-normal">Moyen</span>
                        </div>
                    </div>
                </div>

                <div class="widget-card">
                    <div class="widget-header">
                        <div class="widget-title">Dernières Activités</div>
                    </div>

                    <div style="font-size: 0.875rem; color: var(--color-slate-600); display: flex; flex-direction: column; gap: 0.75rem;">
                        <div style="display: flex; gap: 0.5rem;">
                            <span style="color: var(--color-slate-400);">10:45</span>
                            <span><strong>Marie L.</strong> a créé le devis <a href="#" style="color:var(--color-primary-600)">#D-2024-001</a> pour Client X.</span>
                        </div>

                        <div style="display: flex; gap: 0.5rem;">
                            <span style="color: var(--color-slate-400);">Hier</span>
                            <span><strong>Système</strong> : Backup mensuel effectué avec succès.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [ 'firstname' ],
}
</script>

<style scoped>
.custom-scroll::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.custom-scroll::-webkit-scrollbar-track {
    background: transparent;
}

.custom-scroll::-webkit-scrollbar-thumb {
    background-color: var(--color-slate-300);
    border-radius: 10px;
}

.custom-scroll::-webkit-scrollbar-thumb:hover {
    background-color: var(--color-slate-400);
}

.main-scroll-area {
    flex: 1;
    overflow-y: auto;
    padding: 2rem;
}

.welcome-banner {
    margin-bottom: 2rem;
}

.welcome-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--color-slate-900);
}

.welcome-subtitle {
    color: var(--color-slate-500);
    margin-top: 0.25rem;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.widget-card {
    background-color: white;
    border-radius: var(--radius-xl);
    border: 1px solid var(--color-slate-200);
    box-shadow: var(--shadow-card);
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
}

.widget-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.widget-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--color-slate-900);
}

.widget-action {
    font-size: 0.875rem;
    color: var(--color-primary-600);
    font-weight: 500;
    cursor: pointer;
}

.agenda-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.agenda-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--color-slate-100);
}

.agenda-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.agenda-time {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--color-slate-900);
    min-width: 3.5rem;
}

.agenda-details {
    flex: 1;
}

.agenda-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--color-slate-800);
}

.agenda-meta {
    font-size: 0.75rem;
    color: var(--color-slate-500);
    margin-top: 0.25rem;
    display: flex;
    gap: 0.5rem;
}

.task-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--color-slate-50);
}

.task-check {
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid var(--color-slate-300);
    border-radius: 0.375rem;
    cursor: pointer;
}

.task-content {
    flex: 1;
    font-size: 0.875rem;
    color: var(--color-slate-700);
}

.task-tag {
    font-size: 0.7rem;
    font-weight: 600;
    padding: 0.125rem 0.5rem;
    border-radius: 1rem;
}

.tag-urgent {
    background-color: var(--color-danger-100);
    color: var(--color-danger-600);
}

.tag-normal {
    background-color: var(--color-primary-100);
    color: var(--color-primary-600);
}

@media (max-width: 1280px) {
    .dashboard-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>