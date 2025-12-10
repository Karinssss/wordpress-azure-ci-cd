<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CloudSec Lab | Demo CI/CD con WordPress</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
         :root {
            --bg-main: #050816;
            --bg-card: rgba(15, 23, 42, 0.9);
            --accent: #00e5ff;
            --accent-soft: rgba(0, 229, 255, 0.2);
            --accent-2: #22c55e;
            --text-main: #e5e7eb;
            --text-muted: #9ca3af;
            --border-subtle: rgba(148, 163, 184, 0.2);
            --shadow-soft: 0 20px 40px rgba(15, 23, 42, 0.9);
            --radius-xl: 20px;
            --radius-full: 999px;
            --transition-fast: 0.2s ease-out;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: radial-gradient(circle at top, #1e293b 0, #020617 45%, #000 100%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            padding: 32px 16px;
        }
        
        .page {
            width: 100%;
            max-width: 1180px;
            border-radius: 32px;
            padding: 28px 26px;
            background: radial-gradient(circle at top left, rgba(56, 189, 248, 0.1), transparent 55%), radial-gradient(circle at bottom right, rgba(34, 197, 94, 0.08), transparent 55%), rgba(15, 23, 42, 0.96);
            border: 1px solid rgba(148, 163, 184, 0.15);
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(26px);
            position: relative;
            overflow: hidden;
        }
        
        .page::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(148, 163, 184, 0.08) 1px, transparent 1px), linear-gradient(90deg, rgba(148, 163, 184, 0.06) 1px, transparent 1px);
            background-size: 22px 22px;
            opacity: 0.6;
            mix-blend-mode: soft-light;
            pointer-events: none;
        }
        
        .page-inner {
            position: relative;
            z-index: 1;
        }
        
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 32px;
        }
        
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .brand-logo {
            width: 38px;
            height: 38px;
            border-radius: 14px;
            background: radial-gradient(circle at 20% 20%, #22c55e, #06b6d4, #0f172a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ecfeff;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 15px 35px rgba(6, 182, 212, 0.45);
        }
        
        .brand-text h1 {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0.02em;
        }
        
        .brand-text span {
            font-size: 12px;
            color: var(--text-muted);
        }
        
        .tagline {
            font-size: 12px;
            color: var(--text-muted);
            text-align: right;
        }
        
        .tagline span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.4);
            background: rgba(15, 23, 42, 0.85);
            font-size: 11px;
        }
        
        .tagline-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.35);
        }
        
        .layout {
            display: grid;
            grid-template-columns: minmax(0, 2.1fr) minmax(0, 1.6fr);
            gap: 22px;
        }
        
        @media (max-width: 900px) {
            .layout {
                grid-template-columns: minmax(0, 1fr);
            }
            header {
                flex-direction: column;
                align-items: flex-start;
            }
            .tagline {
                text-align: left;
            }
        }
        
        .hero-card {
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            border: 1px solid var(--border-subtle);
            padding: 22px 22px 20px;
            box-shadow: var(--shadow-soft);
            position: relative;
            overflow: hidden;
        }
        
        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 5px 10px;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(148, 163, 184, 0.4);
            font-size: 11px;
            color: var(--text-muted);
            margin-bottom: 14px;
        }
        
        .hero-label span {
            padding: 2px 6px;
            border-radius: 999px;
            font-size: 10px;
            background: rgba(56, 189, 248, 0.2);
            color: #e0f2fe;
        }
        
        .hero-title {
            font-size: 26px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 10px;
        }
        
        .hero-title span {
            background: linear-gradient(120deg, #38bdf8, #22c55e, #a855f7);
            -webkit-background-clip: text;
            color: transparent;
        }
        
        .hero-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            max-width: 520px;
            margin-bottom: 18px;
        }
        
        .hero-subtitle strong {
            color: #e5e7eb;
            font-weight: 500;
        }
        
        .hero-highlights {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 18px;
        }
        
        .pill {
            font-size: 11px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.55);
            background: rgba(15, 23, 42, 0.95);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .pill-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #38bdf8;
        }
        
        .hero-footer {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px;
            margin-top: 4px;
        }
        
        .hero-button {
            padding: 8px 18px;
            border-radius: var(--radius-full);
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.01em;
            background: linear-gradient(135deg, #22c55e, #06b6d4);
            color: #f9fafb;
            box-shadow: 0 10px 25px rgba(6, 182, 212, 0.6);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform var(--transition-fast), box-shadow var(--transition-fast), filter var(--transition-fast);
        }
        
        .hero-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 35px rgba(6, 182, 212, 0.7);
            filter: brightness(1.05);
        }
        
        .hero-metadata {
            font-size: 11px;
            color: var(--text-muted);
        }
        
        .hero-metadata strong {
            color: #e5e7eb;
            font-weight: 500;
        }
        
        .right-col {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        
        .card {
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            border: 1px solid var(--border-subtle);
            padding: 18px 18px 16px;
            box-shadow: var(--shadow-soft);
            position: relative;
            overflow: hidden;
        }
        
        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }
        
        .card-title {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.02em;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .card-title-badge {
            padding: 3px 8px;
            border-radius: 999px;
            background: rgba(22, 163, 74, 0.15);
            color: #bbf7d0;
            font-size: 10px;
            border: 1px solid rgba(34, 197, 94, 0.35);
        }
        
        .card-header-meta {
            font-size: 11px;
            color: var(--text-muted);
        }
        
        .timeline {
            display: grid;
            gap: 8px;
            padding-left: 4px;
        }
        
        .tl-item {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 10px;
            align-items: start;
        }
        
        .tl-marker {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #f97316;
            box-shadow: 0 0 0 3px rgba(248, 171, 94, 0.4);
            margin-top: 4px;
        }
        
        .tl-content {
            font-size: 11px;
            color: var(--text-main);
            border-radius: 12px;
            padding: 8px 10px;
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid rgba(148, 163, 184, 0.25);
        }
        
        .tl-content span {
            display: block;
            font-size: 10px;
            color: var(--text-muted);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        
        .stack-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 6px;
        }
        
        .stack-pill {
            border-radius: 14px;
            border: 1px solid rgba(148, 163, 184, 0.4);
            padding: 8px 8px 7px;
            font-size: 11px;
            background: rgba(15, 23, 42, 0.92);
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        
        .stack-pill span {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
        }
        
        .stack-pill strong {
            font-weight: 500;
        }
        
        .status-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
            font-size: 11px;
            color: var(--text-muted);
        }
        
        .status-badge {
            padding: 4px 9px;
            border-radius: 999px;
            font-size: 10px;
            border: 1px solid rgba(52, 211, 153, 0.45);
            background: rgba(22, 163, 74, 0.1);
            color: #a7f3d0;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22c55e;
        }
        
        footer {
            margin-top: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            font-size: 11px;
            color: var(--text-muted);
        }
        
        footer a {
            color: #38bdf8;
            text-decoration: none;
            border-bottom: 1px dashed rgba(56, 189, 248, 0.5);
            padding-bottom: 1px;
        }
        
        footer a:hover {
            color: #e0f2fe;
            border-bottom-style: solid;
        }
        
        @media (max-width: 600px) {
            .page {
                padding: 20px 16px;
                border-radius: 22px;
            }
            .hero-title {
                font-size: 22px;
            }
            .hero-subtitle {
                font-size: 12px;
            }
            .stack-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
    </style>
</head>

<body>
    <main class="page">
        <div class="page-inner">
            <header>
                <div class="brand">
                    <div class="brand-logo">WP</div>
                    <div class="brand-text">
                        <h1>WordPress CI/CD Lab</h1>
                        <span>GitHub Actions · Docker · Trivy · Docker Hub</span>
                    </div>
                </div>
                <div class="tagline">
                    <span>
            <div class="tagline-dot"></div>
            Demo DevSecOps con contenedores
        </span>
                </div>
            </header>

            <section class="layout">
                <!-- Columna izquierda (Hero) -->
                <section class="hero-card">
                    <div class="hero-label">
                        Laboratorio en tiempo real
                        <span>WordPress Hardening</span>
                    </div>
                    <h2 class="hero-title">
                        Pipeline CI/CD segura para <span>WordPress</span> en la nube.
                    </h2>
                    <p class="hero-subtitle">
                        Esta página es servida desde una imagen Docker de WordPress construida y publicada automáticamente con <strong>GitHub Actions</strong>. Cada cambio en el código genera un nuevo build, se analiza con <strong>Trivy</strong> y solo
                        entonces se envía a
                        <strong>Docker Hub</strong> para su despliegue.
                    </p>

                    <div class="hero-highlights">
                        <div class="pill">
                            <div class="pill-dot"></div>
                            Integración continua con GitHub Actions
                        </div>
                        <div class="pill">
                            <div class="pill-dot"></div>
                            Análisis de vulnerabilidades en imágenes Docker
                        </div>
                        <div class="pill">
                            <div class="pill-dot"></div>
                            Publicación automática en Docker Hub
                        </div>
                        <div class="pill">
                            <div class="pill-dot"></div>
                            Aplicación final: WordPress endurecido
                        </div>
                    </div>

                    <div class="hero-footer">
                        <button class="hero-button" onclick="window.location.href='/wp-admin'">
                Ir al panel de WordPress
                <span>↗</span>
            </button>
                        <div class="hero-metadata">
                            <strong>Build actual:</strong> generado desde la pipeline CI/CD segura.
                        </div>
                    </div>
                </section>

                <!-- Columna derecha -->
                <section class="right-col">
                    <article class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Flujo de alto nivel PRUEBA
                                <span class="card-title-badge">Pipeline CI/CD</span>
                            </div>
                            <div class="card-header-meta">Eventos clave de la automatización</div>
                        </div>

                        <div class="timeline">
                            <div class="tl-item">
                                <div class="tl-marker"></div>
                                <div class="tl-content">
                                    <span>Paso 01 · Commit & Push</span> El desarrollador actualiza el repo en GitHub (Dockerfile, index, configuración). Un simple <code>git push</code> dispara la pipeline de CI/CD.
                                </div>
                            </div>
                            <div class="tl-item">
                                <div class="tl-marker"></div>
                                <div class="tl-content">
                                    <span>Paso 02 · Build + Seguridad</span> GitHub Actions construye la imagen Docker de WordPress y ejecuta
                                    <strong>Trivy</strong> para detectar vulnerabilidades en el sistema base y dependencias.
                                </div>
                            </div>
                            <div class="tl-item">
                                <div class="tl-marker"></div>
                                <div class="tl-content">
                                    <span>Paso 03 · Registro & Despliegue</span> La imagen aprobada se publica en <strong>Docker Hub</strong>. Un host con Docker hace <code>docker pull</code> y levanta el contenedor que ahora muestra esta página.
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Stack utilizado
                            </div>
                            <div class="card-header-meta">Componentes principales de la demo</div>
                        </div>

                        <div class="stack-grid">
                            <div class="stack-pill">
                                <span>Repositorio</span>
                                <strong>GitHub</strong>
                                <small>Código fuente y definición del workflow.</small>
                            </div>
                            <div class="stack-pill">
                                <span>Pipeline</span>
                                <strong>GitHub Actions</strong>
                                <small>CI/CD orquestado por eventos de push.</small>
                            </div>
                            <div class="stack-pill">
                                <span>Seguridad</span>
                                <strong>Trivy</strong>
                                <small>Escaneo de vulnerabilidades en contenedores.</small>
                            </div>
                            <div class="stack-pill">
                                <span>Runtime</span>
                                <strong>Docker</strong>
                                <small>Ejecución aislada de WordPress.</small>
                            </div>
                            <div class="stack-pill">
                                <span>Registro</span>
                                <strong>Docker Hub</strong>
                                <small>Almacén de imágenes versionadas.</small>
                            </div>
                            <div class="stack-pill">
                                <span>Aplicación</span>
                                <strong>WordPress</strong>
                                <small>CMS para la capa de contenido.</small>
                            </div>
                        </div>

                        <div class="status-row">
                            <div>Estado actual del laboratorio:</div>
                            <div class="status-badge">
                                <div class="status-dot"></div>
                                Última imagen generada por la pipeline
                            </div>
                        </div>
                    </article>
                </section>
            </section>

            <footer>
                <div>
                    WordPress CI/CD Lab · Demo educativa de automatización y seguridad con contenedores.
                </div>
                <div>
                    Desplegado desde: <a href="#">Pipeline GitHub Actions + Docker Hub</a>
                </div>
            </footer>
        </div>
    </main>
</body>

</html>
