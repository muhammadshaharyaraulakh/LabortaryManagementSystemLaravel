<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketMind AI — Research Paper Repository</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=IBM+Plex+Mono:wght@400;500&family=Inter:wght@300;400;500&display=swap');

        :root {
            --bg: #0a0c10;
            --surface: #111418;
            --card: #161b22;
            --border: #21272f;
            --accent: #00e5a0;
            --accent2: #3d9eff;
            --accent3: #ff6b6b;
            --text: #e6edf3;
            --muted: #8b949e;
            --tag-bg: #1f2937;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 0;
        }

        /* HEADER */
        header {
            background: linear-gradient(135deg, #0d1117 0%, #0f1923 50%, #0d1117 100%);
            border-bottom: 1px solid var(--border);
            padding: 48px 40px 36px;
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(0, 229, 160, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        header::after {
            content: '';
            position: absolute;
            bottom: -40px;
            left: 30%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(61, 158, 255, 0.06) 0%, transparent 70%);
            border-radius: 50%;
        }

        .header-badge {
            display: inline-block;
            background: rgba(0, 229, 160, 0.1);
            border: 1px solid rgba(0, 229, 160, 0.3);
            color: var(--accent);
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 2px;
            margin-bottom: 16px;
        }

        header h1 {
            font-family: 'Syne', sans-serif;
            font-size: 42px;
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.1;
            margin-bottom: 10px;
        }

        header h1 span {
            color: var(--accent);
        }

        .header-sub {
            font-size: 14px;
            color: var(--muted);
            font-weight: 300;
            margin-bottom: 28px;
            max-width: 600px;
            line-height: 1.6;
        }

        .header-stats {
            display: flex;
            gap: 32px;
            flex-wrap: wrap;
        }

        .stat {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--accent);
        }

        .stat-label {
            font-size: 11px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'IBM Plex Mono', monospace;
        }

        /* META INFO */
        .meta-bar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 14px 40px;
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
            align-items: center;
        }

        .meta-item {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            color: var(--muted);
        }

        .meta-item strong {
            color: var(--text);
        }

        /* LEGEND */
        .legend {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 16px 40px;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            align-items: center;
        }

        .legend-label {
            font-size: 11px;
            color: var(--muted);
            font-family: 'IBM Plex Mono', monospace;
            margin-right: 8px;
        }

        .tag {
            display: inline-block;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.5px;
            padding: 3px 9px;
            border-radius: 3px;
            text-transform: uppercase;
        }

        .tag-crm {
            background: rgba(255, 107, 107, 0.15);
            color: #ff6b6b;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        .tag-bi {
            background: rgba(61, 158, 255, 0.15);
            color: #3d9eff;
            border: 1px solid rgba(61, 158, 255, 0.3);
        }

        .tag-wa {
            background: rgba(0, 229, 160, 0.12);
            color: var(--accent);
            border: 1px solid rgba(0, 229, 160, 0.3);
        }

        .tag-email {
            background: rgba(249, 168, 37, 0.12);
            color: #f9a825;
            border: 1px solid rgba(249, 168, 37, 0.3);
        }

        .tag-api {
            background: rgba(190, 75, 210, 0.12);
            color: #be4bd2;
            border: 1px solid rgba(190, 75, 210, 0.3);
        }

        .tag-social {
            background: rgba(255, 160, 0, 0.12);
            color: #ffa000;
            border: 1px solid rgba(255, 160, 0, 0.3);
        }

        /* CONTENT */
        .content {
            padding: 32px 40px 60px;
        }

        /* PAPER CARD */
        .paper-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 6px;
            margin-bottom: 24px;
            overflow: hidden;
            transition: border-color 0.2s;
        }

        .paper-card:hover {
            border-color: rgba(0, 229, 160, 0.25);
        }

        .card-header {
            display: grid;
            grid-template-columns: 56px 1fr auto;
            align-items: start;
            gap: 16px;
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(90deg, rgba(0, 229, 160, 0.03) 0%, transparent 100%);
        }

        .paper-num {
            font-family: 'Syne', sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: rgba(0, 229, 160, 0.2);
            line-height: 1;
            padding-top: 4px;
        }

        .paper-title-block h2 {
            font-family: 'Syne', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            line-height: 1.4;
            margin-bottom: 6px;
        }

        .paper-authors {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .paper-meta-line {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .year-badge {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            color: var(--accent);
            background: rgba(0, 229, 160, 0.1);
            padding: 2px 8px;
            border-radius: 2px;
        }

        .source-badge {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10px;
            color: var(--muted);
            background: var(--tag-bg);
            padding: 2px 8px;
            border-radius: 2px;
        }

        .card-link {
            color: var(--accent2);
            text-decoration: none;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            display: flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
            padding-top: 4px;
            opacity: 0.85;
        }

        .card-link:hover {
            opacity: 1;
            text-decoration: underline;
        }

        .card-link::before {
            content: '↗';
            font-size: 13px;
        }

        /* DETAILS GRID */
        .card-body {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0;
            border-bottom: none;
        }

        .detail-cell {
            padding: 18px 24px;
            border-right: 1px solid var(--border);
        }

        .detail-cell:last-child {
            border-right: none;
        }

        .detail-label {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .detail-label::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .dl-algo::before {
            background: var(--accent);
        }

        .dl-eff::before {
            background: var(--accent2);
        }

        .dl-attr::before {
            background: #f9a825;
        }

        .detail-text {
            font-size: 12.5px;
            color: #c9d1d9;
            line-height: 1.65;
        }

        .attr-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 4px;
        }

        .attr-tag {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10px;
            background: var(--tag-bg);
            color: var(--muted);
            border: 1px solid var(--border);
            padding: 3px 8px;
            border-radius: 3px;
        }

        /* SECTION DIVIDER */
        .section-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 32px 0 20px;
        }

        .section-divider span {
            font-family: 'Syne', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 2px;
            white-space: nowrap;
        }

        .section-divider::before,
        .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* FOOTER */
        footer {
            background: var(--surface);
            border-top: 1px solid var(--border);
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        footer p {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            color: var(--muted);
        }

        footer strong {
            color: var(--accent);
        }

        @media (max-width: 768px) {

            header,
            .content,
            .meta-bar,
            .legend,
            footer {
                padding-left: 20px;
                padding-right: 20px;
            }

            header h1 {
                font-size: 28px;
            }

            .card-body {
                grid-template-columns: 1fr;
            }

            .detail-cell {
                border-right: none;
                border-bottom: 1px solid var(--border);
            }

            .card-header {
                grid-template-columns: 44px 1fr;
            }

            .card-link {
                display: none;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="header-badge">Final Year Project — Literature Review</div>
        <h1>MarketMind AI<br><span>Research Paper Repository</span></h1>
        <p class="header-sub">
            20 curated open-access research papers indexed on Google Scholar, focused on web-based digital marketing
            systems, analytics dashboards, CRM architectures, business intelligence, and web tracking — all
            implementable with Vue.js &amp; Laravel.
        </p>
        <div class="header-stats">
            <div class="stat"><span class="stat-num">20</span><span class="stat-label">Papers Selected</span></div>
            <div class="stat"><span class="stat-num">6</span><span class="stat-label">Topic Domains</span></div>
            <div class="stat"><span class="stat-num">2014–24</span><span class="stat-label">Publication Range</span>
            </div>
            <div class="stat"><span class="stat-num">100%</span><span class="stat-label">Open Access / PDF</span></div>
        </div>
    </header>

    <div class="meta-bar">
        <span class="meta-item">Project: <strong>MarketMind AI — Intelligence Digital Marketing Platform &amp; Analytics
                Engine</strong></span>
        <span class="meta-item">Stack: <strong>Vue.js + Laravel</strong></span>
        <span class="meta-item">Source: <strong>Google Scholar Indexed</strong></span>
    </div>

    <div class="legend">
        <span class="legend-label">CATEGORIES →</span>
        <span class="tag tag-crm">CRM Systems</span>
        <span class="tag tag-bi">Business Intelligence</span>
        <span class="tag tag-wa">Web Analytics</span>
        <span class="tag tag-email">Email Marketing</span>
        <span class="tag tag-api">Web API / Architecture</span>
        <span class="tag tag-social">Social &amp; Campaign Analytics</span>
    </div>

    <div class="content">

        <!-- ─── SECTION 1: WEB ANALYTICS & TRACKING ─── -->
        <div class="section-divider"><span>§1 — Web Analytics &amp; Tracking</span></div>

        <!-- PAPER 1 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">01</div>
                <div class="paper-title-block">
                    <h2>Web Analytics Overview: Measuring, Collecting, Analysing and Reporting Internet Data</h2>
                    <div class="paper-authors">Jansen, B. J. (2009/2015) — Morgan &amp; Claypool / ResearchGate</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2015</span>
                        <span class="tag tag-wa">Web Analytics</span>
                        <span class="source-badge">ResearchGate · Google Scholar Indexed</span>
                    </div>
                </div>
                <a class="card-link" href="https://www.researchgate.net/publication/272815693_Web_Analytics_Overview"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Clickstream analysis, conversion funnel tracking, heat-map generation via
                        client-side JavaScript, visitor segmentation, and KPI-based reporting. Uses data collection via
                        server logs and JS tagging, followed by ETL processing into aggregated metrics.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">JavaScript-based page tagging reduces server load vs. log-file parsing.
                        Real-time visitor tracking reduces data latency to near-zero. Conversion analysis identifies
                        bottlenecks, improving campaign ROI by measurable percentages without infrastructure changes.
                    </div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">Clickstream Analysis</span>
                        <span class="attr-tag">Conversion Tracking</span>
                        <span class="attr-tag">Heat Map</span>
                        <span class="attr-tag">Visitor Segmentation</span>
                        <span class="attr-tag">KPI Dashboard</span>
                        <span class="attr-tag">e-CRM Integration</span>
                        <span class="attr-tag">JS Tagging</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 2 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">02</div>
                <div class="paper-title-block">
                    <h2>Popular, but Hardly Used: Has Google Analytics Been to the Detriment of Web Analytics?</h2>
                    <div class="paper-authors">Alby, T. (2023) — ACM Web Science Conference (WebSci '23)</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2023</span>
                        <span class="tag tag-wa">Web Analytics</span>
                        <span class="source-badge">ACM Digital Library · CC Open Access</span>
                    </div>
                </div>
                <a class="card-link" href="https://dl.acm.org/doi/fullHtml/10.1145/3578503.3583601" target="_blank">Full
                    Text</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Empirical large-scale survey of 10,000+ websites using GA Universal
                        Analytics vs. GA4. Comparative analysis of event tracking adoption rates, server-side tagging
                        implementation, and Enhanced Event Measurement activation. Uses W3Techs dataset and statistical
                        analysis.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Server-side tagging (GA4 + GTM) reduces client-side JS payload, improving
                        page load speed. GA4's event-based model replaces session-based tracking, offering 40% more
                        granular user journey data. Demonstrates migration path for privacy-compliant analytics
                        post-GDPR.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">GA4 Architecture</span>
                        <span class="attr-tag">Event-Based Tracking</span>
                        <span class="attr-tag">Server-Side Tagging</span>
                        <span class="attr-tag">GDPR Compliance</span>
                        <span class="attr-tag">BigQuery Integration</span>
                        <span class="attr-tag">Privacy-First Analytics</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 3 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">03</div>
                <div class="paper-title-block">
                    <h2>Research Challenges in Web Analytics — A Study</h2>
                    <div class="paper-authors">Suresh Kumar, K. &amp; Vijayarani, S. (2023) — International Research
                        Journal of Engineering and Technology (IRJET)</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2023</span>
                        <span class="tag tag-wa">Web Analytics</span>
                        <span class="source-badge">IRJET Vol.10 Issue 8 · Open Access PDF</span>
                    </div>
                </div>
                <a class="card-link" href="https://www.irjet.net/archives/V10/i8/IRJET-V10I8132.pdf"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Six-step web analytics process: data collection → data processing → data
                        storage → data analysis → reporting → action. Employs e-commerce usability analysis using Google
                        Analytics, heuristic evaluation, and A/B testing. Uses KNIME, R, and Python as open-source
                        analytics tools.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Structured six-stage pipeline eliminates redundant data passes. Combining
                        GA with heuristic evaluation reduces UX testing cycle by ~30%. Open-source toolchain (KNIME +
                        Python) cuts licensing costs to zero while maintaining enterprise-grade analytical output.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">E-commerce Analytics</span>
                        <span class="attr-tag">Data Privacy</span>
                        <span class="attr-tag">Cookie-Based Tracking</span>
                        <span class="attr-tag">Campaign Measurement</span>
                        <span class="attr-tag">e-CRM</span>
                        <span class="attr-tag">6-Step Pipeline</span>
                        <span class="attr-tag">Open-Source Tools</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 4 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">04</div>
                <div class="paper-title-block">
                    <h2>Web Tracking — A Literature Review on the State of Research</h2>
                    <div class="paper-authors">Bachmann, A., Kemper, G. &amp; Gerzer, T. (2018) — ResearchGate / Journal
                        of Information, Information Technology and Organizations</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2018</span>
                        <span class="tag tag-wa">Web Analytics</span>
                        <span class="source-badge">ResearchGate · Open Access PDF</span>
                    </div>
                </div>
                <a class="card-link"
                    href="https://www.researchgate.net/publication/319650216_Web_Tracking_-_A_Literature_Review_on_the_State_of_Research"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Systematic literature review of web tracking technologies: first-party
                        cookies, third-party tracking pixels, browser fingerprinting, cross-device tracking, and social
                        integration buttons. Classifies tracking by business model: advertising networks (Quantcast,
                        GA), analytics, and social platforms.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Comprehensive taxonomy enables developers to choose the most
                        privacy-compliant tracking method per use case. Third-party blocking reduced overall ad revenue
                        by 75% (Gill et al.), driving adoption of first-party data strategies — directly relevant for
                        GDPR-compliant marketing platforms.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">Cross-Device Tracking</span>
                        <span class="attr-tag">Browser Fingerprinting</span>
                        <span class="attr-tag">Ad Networks</span>
                        <span class="attr-tag">Cookie Management</span>
                        <span class="attr-tag">Privacy & GDPR</span>
                        <span class="attr-tag">Conversion Attribution</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── SECTION 2: BUSINESS INTELLIGENCE DASHBOARDS ─── -->
        <div class="section-divider"><span>§2 — Business Intelligence &amp; Dashboards</span></div>

        <!-- PAPER 5 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">05</div>
                <div class="paper-title-block">
                    <h2>A Business Intelligence Dashboard Design Approach to Improve Decision Making</h2>
                    <div class="paper-authors">Orlovskyi, D. &amp; Kopp, A. (2020) — IT&amp;I-2020 Conference
                        Proceedings, CEUR-WS</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2020</span>
                        <span class="tag tag-bi">Business Intelligence</span>
                        <span class="source-badge">CEUR-WS Vol.2833 · CC BY 4.0</span>
                    </div>
                </div>
                <a class="card-link" href="https://ceur-ws.org/Vol-2833/Paper_5.pdf" target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Threshold-based data visualization algorithm: 12 threshold combinations (t₁
                        × t₂) applied to SQL-derived flat datasets. Five data subsets (avg. revenue by quarter, sales by
                        month, revenue by date, avg. per item, avg. per quarter) visualized via layered charts. D3.js
                        and Kibana components.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">SQL pre-aggregation reduces front-end rendering time significantly.
                        Threshold-based alerts reduce manual report review by auto-highlighting anomalies. Dashboard
                        replaces static reports, reducing decision cycle from days to minutes. Compatible with
                        open-source BI stack (D3.js, Kibana).</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">BI Architecture</span>
                        <span class="attr-tag">SQL Aggregation</span>
                        <span class="attr-tag">Threshold Alerts</span>
                        <span class="attr-tag">KPI Charts</span>
                        <span class="attr-tag">D3.js / Kibana</span>
                        <span class="attr-tag">Data Warehouse</span>
                        <span class="attr-tag">OLAP</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 6 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">06</div>
                <div class="paper-title-block">
                    <h2>Building Business Intelligence Dashboards with Power BI and Snowflake</h2>
                    <div class="paper-authors">Pagidi, R. K., Alahari, J., Ayyagiri, A. et al. (2023) — IJPREMS Vol.03
                        Issue 12</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2023</span>
                        <span class="tag tag-bi">Business Intelligence</span>
                        <span class="source-badge">IJPREMS · Open Access PDF</span>
                    </div>
                </div>
                <a class="card-link"
                    href="https://www.ijprems.com/uploadedfiles/paper/issue_12_december_2023/32316/final/fin_ijprems1727783372.pdf"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Power BI + Snowflake integration using DirectQuery and Import Mode. DAX
                        (Data Analysis Expressions) for dynamic KPI calculations. ETL pipeline: raw data → Snowflake
                        cloud warehouse → Power BI semantic layer → interactive dashboard. Concurrent multi-user access
                        via Snowflake's MPP architecture.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Snowflake's MPP reduces query response time under high volume. Majority of
                        users reported improved decision-making speed. Organizations saw significant IT cost reductions
                        post-integration. High user satisfaction (data clarity). Error rates manageable under optimized
                        query configurations.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">Cloud Data Warehouse</span>
                        <span class="attr-tag">DAX Calculations</span>
                        <span class="attr-tag">ETL Pipeline</span>
                        <span class="attr-tag">Real-Time Dashboards</span>
                        <span class="attr-tag">Scalable BI</span>
                        <span class="attr-tag">Multi-User Concurrency</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 7 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">07</div>
                <div class="paper-title-block">
                    <h2>Integrating Tableau, SQL, and Visualization for Dashboard-Driven BI Decision Making</h2>
                    <div class="paper-authors">Multiple Authors (2024) — American Journal of Advanced Technology and
                        Engineering Solutions (AJATES)</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2024</span>
                        <span class="tag tag-bi">Business Intelligence</span>
                        <span class="source-badge">AJATES · Open Access PDF</span>
                    </div>
                </div>
                <a class="card-link" href="https://ajates-scholarly.com/index.php/ajates/article/download/56/52"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">SQL-centric BI architecture: relational querying with star-schema data
                        warehouses, OLAP multidimensional models (MDX/DAX), and query pushdown to MPP engines. Governed
                        semantic layer (LookML vs. Tableau worksheets). CI/CD pipelines for version-controlled SQL
                        dashboards using Git.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Indexing, partitioning, and pushdown queries improve dashboard render time.
                        Organizations with structured testing and monitoring frameworks report higher user trust and
                        lower maintenance costs. SQL remains dominant for structured data — 40% faster queries than
                        NoSQL alternatives for BI use cases.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">SQL Star Schema</span>
                        <span class="attr-tag">OLAP Cubes</span>
                        <span class="attr-tag">Tableau / Power BI / Qlik</span>
                        <span class="attr-tag">Semantic Layer</span>
                        <span class="attr-tag">Query Optimization</span>
                        <span class="attr-tag">Git Version Control</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 8 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">08</div>
                <div class="paper-title-block">
                    <h2>Study on Business Intelligence Tools for Enterprise Dashboard Development</h2>
                    <div class="paper-authors">Gowthami, K. &amp; Pavan Kumar, M. R. (2017) — IRJET Vol.4 Issue 4</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2017</span>
                        <span class="tag tag-bi">Business Intelligence</span>
                        <span class="source-badge">IRJET · Open Access PDF</span>
                    </div>
                </div>
                <a class="card-link" href="https://www.irjet.net/archives/V4/i4/IRJET-V4I4721.pdf" target="_blank">Full
                    PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Comparative evaluation of five BI suites (SpagoBI, Power BI, Tableau,
                        QlikSense, JasperSoft) across criteria: ease of use, open-source availability, training support,
                        and cost. Prototype dashboard built using Power BI with live data connectivity (Marketo,
                        Sendgrid, Zendesk) and SSAS live connection.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Power BI's web-based deployment eliminates desktop client management
                        overhead. SpagoBI (fully open-source, 15 components) covers entire BI stack at zero license
                        cost. Live connectivity to CRM/email tools (Zendesk, Marketo) enables sub-second dashboard
                        refresh without ETL jobs.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">BI Tool Comparison</span>
                        <span class="attr-tag">Open-Source BI</span>
                        <span class="attr-tag">Live Connectivity</span>
                        <span class="attr-tag">CRM Integration</span>
                        <span class="attr-tag">Web-Based Deployment</span>
                        <span class="attr-tag">ETL / OLAP</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── SECTION 3: CRM SYSTEMS ─── -->
        <div class="section-divider"><span>§3 — CRM Systems &amp; Architecture</span></div>

        <!-- PAPER 9 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">09</div>
                <div class="paper-title-block">
                    <h2>Design and Implementation of an Automated Customer Relationship Management System</h2>
                    <div class="paper-authors">Dey, S., Patwary, M. K. H., Rashid, M. H. U. et al. (2021) — ResearchGate
                        / IEEE</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2021</span>
                        <span class="tag tag-crm">CRM Systems</span>
                        <span class="source-badge">ResearchGate · Open Access PDF</span>
                    </div>
                </div>
                <a class="card-link"
                    href="https://www.researchgate.net/publication/353659528_Design_and_Implementation_of_an_Automated_Customer_Relationship_Management_System"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Web-based CRM with automated email communication triggered by database
                        events. Customer segmentation into groups using data mining and web analytics. Architecture: PHP
                        + MySQL backend, Apache server (XAMPP), CSS/HTML frontend. Customer paging (10 per page),
                        descending-order listing, group-based campaign dispatch.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Automation eliminates manual email dispatch — campaigns targeting 50,000+
                        customers execute without human intervention. Group-based segmentation improves email relevance,
                        increasing open rates. Database-driven customer profiling enables predictive communication
                        timing, reducing churn.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">Web-Based CRM</span>
                        <span class="attr-tag">Automated Email</span>
                        <span class="attr-tag">Customer Segmentation</span>
                        <span class="attr-tag">PHP + MySQL</span>
                        <span class="attr-tag">Data Mining</span>
                        <span class="attr-tag">Group Management</span>
                        <span class="attr-tag">CRUD Operations</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 10 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">10</div>
                <div class="paper-title-block">
                    <h2>Web-Based CRM System for Educational Sector Integrated with Mobile Instance Message (WhatsApp)
                    </h2>
                    <div class="paper-authors">Multiple Authors (2021) — ResearchGate / IIUM Engineering Journal</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2021</span>
                        <span class="tag tag-crm">CRM Systems</span>
                        <span class="source-badge">ResearchGate · Open Access PDF</span>
                    </div>
                </div>
                <a class="card-link"
                    href="https://www.researchgate.net/publication/354399958_WEB-BASED_CUSTOMER_RELATIONSHIP_MANAGEMENT_CRM_SYSTEM_FOR_EDUCATIONAL_SECTOR_INTEGRATED_WITH_MOBILE_INSTANCE_MESSAGE_MIM_USING_WHATSAPP_APPLICATION"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Waterfall SDLC methodology. Three-tier architecture: client browser →
                        PHP/MySQL web server → WhatsApp Business API. Admin and customer roles. System architecture:
                        computer + web server + mobile notification layer. Usability evaluated via User Experience Test
                        (UXT) with teachers, students, and parents.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">WhatsApp API integration reduces communication latency vs. traditional
                        email alone. Multi-channel (web + mobile) notification improves customer response rates.
                        Dual-role admin/customer interface reduces support overhead. UXT results confirmed satisfactory
                        usability across all user groups.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">3-Tier Architecture</span>
                        <span class="attr-tag">WhatsApp API</span>
                        <span class="attr-tag">PHP / MySQL</span>
                        <span class="attr-tag">Multi-Channel CRM</span>
                        <span class="attr-tag">Waterfall SDLC</span>
                        <span class="attr-tag">Role-Based Access</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 11 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">11</div>
                <div class="paper-title-block">
                    <h2>Design and Implementation of a CRM System for Medium-Sized Digital Printing Enterprises</h2>
                    <div class="paper-authors">Multiple Authors (2024) — JUSIFO (Jurnal Sistem Informasi) Vol.10 No.2
                    </div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2024</span>
                        <span class="tag tag-crm">CRM Systems</span>
                        <span class="source-badge">ResearchGate · Open Access PDF</span>
                    </div>
                </div>
                <a class="card-link"
                    href="https://www.researchgate.net/publication/388123464_Design_and_Implementation_of_a_Customer_Relationship_Management_System_for_Medium-Sized_Digital_Printing_Enterprises"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Iterative prototyping methodology (3 stages: communication → plan/design →
                        iterative prototype). CRM features derived from stakeholder feedback and literature synthesis
                        (Walenta et al., Hardiana &amp; Pramono). System aligns with SME operational requirements.
                        Architecture includes customer portal, sales pipeline, and service automation modules.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Iterative prototyping reduces rework cycles compared to waterfall.
                        SME-tailored features avoid feature bloat of enterprise CRMs. Service operation optimization
                        reduces response time. System architecture can serve as replicable model for similar SME
                        contexts. Scalability noted as future research area.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">SME CRM</span>
                        <span class="attr-tag">Iterative Prototyping</span>
                        <span class="attr-tag">Sales Pipeline</span>
                        <span class="attr-tag">Service Automation</span>
                        <span class="attr-tag">Customer Portal</span>
                        <span class="attr-tag">Stakeholder Validation</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 12 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">12</div>
                <div class="paper-title-block">
                    <h2>CURIE: Towards an Ontology and Enterprise Architecture of a CRM Conceptual Model</h2>
                    <div class="paper-authors">Colebrook, M. et al. (2022) — Business &amp; Information Systems
                        Engineering (BISE), Springer</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2022</span>
                        <span class="tag tag-crm">CRM Systems</span>
                        <span class="source-badge">ResearchGate · Open Access (Springer BISE)</span>
                    </div>
                </div>
                <a class="card-link"
                    href="https://www.researchgate.net/publication/358757572_CURIE_Towards_an_Ontology_and_Enterprise_Architecture_of_a_CRM_Conceptual_Model"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">OntoUML-based conceptual modelling (Unified Foundational Ontology — UFO).
                        Nine CRM model building blocks covering customer journey stages (Stranger → Promoter). OWL (Web
                        Ontology Language) compliant output via gUFO. Case study validation with 15 practitioners across
                        5 companies in real market environment.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">OWL-compliant ontology enables automated reasoning over CRM data, reducing
                        manual categorization effort. Closed-loop CRM architecture integrates analytical CRM knowledge
                        back into transactional CRM — creating intelligent feedback loops. Standardised model reduces
                        custom integration complexity by providing shared vocabulary.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">CRM Ontology</span>
                        <span class="attr-tag">OntoUML / OWL</span>
                        <span class="attr-tag">Customer Journey Model</span>
                        <span class="attr-tag">Analytical CRM</span>
                        <span class="attr-tag">Closed-Loop Architecture</span>
                        <span class="attr-tag">Enterprise Architecture</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 13 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">13</div>
                <div class="paper-title-block">
                    <h2>Advancing Education Management through Integrated CRM Solutions Leveraging Distributed Web
                        Systems Architecture</h2>
                    <div class="paper-authors">Georgieva-Trifonova, T. et al. (2024) — ResearchGate / BRAIN Journal
                    </div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2024</span>
                        <span class="tag tag-crm">CRM Systems</span>
                        <span class="source-badge">ResearchGate · Open Access PDF</span>
                    </div>
                </div>
                <a class="card-link"
                    href="https://www.researchgate.net/publication/390647976_Advancing_education_management_through_integrated_CRM_solutions_leveraging_the_scalability_and_efficiency_of_a_distributed_web_systems_architecture"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Distributed web platform design using CRM technologies with
                        microservice-style architecture. Integration of diverse data sources via REST APIs. Role-based
                        access control (RBAC) for students, educators, and administrators. Data-driven insight
                        generation pipeline for adaptive decision-making. Semantic Web Technologies applied to CRM data
                        modelling.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Distributed architecture enables horizontal scaling under increased user
                        load. CRM-based platforms optimize decision-making processes and resource allocation. Seamless
                        communication between actors reduces administrative overhead. Adaptive teaching strategies
                        improve satisfaction — directly applicable to multi-tenant SaaS marketing platforms.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">Distributed Web Platform</span>
                        <span class="attr-tag">REST API Integration</span>
                        <span class="attr-tag">RBAC</span>
                        <span class="attr-tag">Scalability</span>
                        <span class="attr-tag">Semantic Web</span>
                        <span class="attr-tag">Multi-Tenant Architecture</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── SECTION 4: EMAIL MARKETING SYSTEMS ─── -->
        <div class="section-divider"><span>§4 — Email Marketing Systems</span></div>

        <!-- PAPER 14 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">14</div>
                <div class="paper-title-block">
                    <h2>A Conceptual Model for Effective Email Marketing Using Subscriber Clustering and Segmentation
                    </h2>
                    <div class="paper-authors">Multiple Authors (2014) — ResearchGate / IEEE Conference</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2014</span>
                        <span class="tag tag-email">Email Marketing</span>
                        <span class="source-badge">ResearchGate · Open Access PDF</span>
                    </div>
                </div>
                <a class="card-link"
                    href="https://www.researchgate.net/publication/269994301_A_Conceptual_Model_for_effective_email_marketing"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Two-component model: (1) Subscriber activity data collection via
                        JavaScript/DOM/Ajax tracking (open rate, click rate, web interactions, goal achievements); (2)
                        OLAP Cube + Fact Constellation Schema for multi-dimensional subscriber segmentation. K-means
                        clustering applied to behavioral data to form targeted subscriber groups.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Segmented email campaigns showed measurable improvement in overall
                        subscriber activity performance vs. un-segmented broadcasts. OLAP Cube enables fast
                        multi-dimensional queries over millions of campaign events. JavaScript-based tracking adds zero
                        server load while capturing granular behavioral signals.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">Subscriber Segmentation</span>
                        <span class="attr-tag">OLAP Cube</span>
                        <span class="attr-tag">Open/Click Rate Tracking</span>
                        <span class="attr-tag">JS/DOM/Ajax</span>
                        <span class="attr-tag">K-Means Clustering</span>
                        <span class="attr-tag">Goal Conversion</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 15 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">15</div>
                <div class="paper-title-block">
                    <h2>Modelling E-mail Marketing Effectiveness: An Approach Based on the Theory of
                        Hierarchy-of-Effects</h2>
                    <div class="paper-authors">Lorente-Páramo, Á. J., Hernández-García, Á. &amp; Chaparro-Peláez, J.
                        (2021) — Management Letters / Cuadernos de Gestión 21(1)</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2021</span>
                        <span class="tag tag-email">Email Marketing</span>
                        <span class="source-badge">ResearchGate · Open Access</span>
                    </div>
                </div>
                <a class="card-link"
                    href="https://www.researchgate.net/publication/347546723_Modelling_e-mail_marketing_effectiveness_-_An_approach_based_on_the_theory_of_hierarchy-of-effects"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">AIDA model (Attention → Interest → Desire → Action) mapped to measurable
                        email KPIs: open rate (Attention), click-through rate (Interest), conversion rate
                        (Desire/Action). Statistical regression analysis on campaign data. Hierarchy-of-effects model
                        operationalised for digital channels, enabling systematic campaign benchmarking.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">AIDA-to-KPI mapping eliminates ambiguity in campaign performance
                        attribution. Regression model predicts downstream conversion from upstream metrics (open → click
                        → buy), allowing early campaign optimization. Operational nature makes the model practical for
                        real-time marketing dashboards without ML dependencies.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">AIDA Model</span>
                        <span class="attr-tag">Open Rate</span>
                        <span class="attr-tag">Click-Through Rate</span>
                        <span class="attr-tag">Conversion Funnel</span>
                        <span class="attr-tag">Campaign Attribution</span>
                        <span class="attr-tag">Statistical Regression</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 16 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">16</div>
                <div class="paper-title-block">
                    <h2>Social Media and E-mail Marketing Campaigns: Symmetry versus Convergence</h2>
                    <div class="paper-authors">Multiple Authors (2020) — MDPI Symmetry, 12(12), 1940</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2020</span>
                        <span class="tag tag-email">Email Marketing</span>
                        <span class="tag tag-social">Social &amp; Campaign</span>
                        <span class="source-badge">MDPI · CC BY 4.0</span>
                    </div>
                </div>
                <a class="card-link"
                    href="https://www.researchgate.net/publication/346788663_Social_Media_and_E-mail_Marketing_Campaigns_Symmetry_versus_Convergence"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Statistical T-test and convergence index comparing Facebook social media
                        campaigns vs. email campaigns in the insurance sector. ETL pipeline feeding a Social BI (SBI)
                        platform. Metrics: clicks, links, engagement, open rates. Symmetry analysis: time-aligned
                        parallel campaign execution vs. sequential. Real campaign data from 2020.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Synchronised (symmetric) multi-channel campaigns yield better results than
                        sequential single-channel approaches. SBI platform using ETL produces convergent data views
                        across channels, eliminating silos. $42 ROI per $1 spent on email (Litmus 2019) validated
                        against real campaign data. Results applicable across industries.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">Multi-Channel Marketing</span>
                        <span class="attr-tag">Social BI Platform</span>
                        <span class="attr-tag">ETL Pipeline</span>
                        <span class="attr-tag">T-Test Analysis</span>
                        <span class="attr-tag">Campaign ROI</span>
                        <span class="attr-tag">Cross-Channel Analytics</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── SECTION 5: WEB API & SYSTEM ARCHITECTURE ─── -->
        <div class="section-divider"><span>§5 — Web API &amp; System Architecture</span></div>

        <!-- PAPER 17 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">17</div>
                <div class="paper-title-block">
                    <h2>Development of REST API for Digital Advertising Application Using an Iterative Incremental
                        Method</h2>
                    <div class="paper-authors">Multiple Authors (2023) — ICAISD 2023, SCITEPRESS Proceedings</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2023</span>
                        <span class="tag tag-api">Web API</span>
                        <span class="source-badge">SCITEPRESS · Open Access PDF</span>
                    </div>
                </div>
                <a class="card-link" href="https://www.scitepress.org/Papers/2023/124402/124402.pdf"
                    target="_blank">Full PDF</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Iterative Incremental development model applied to REST API design for a
                        digital advertising platform. JSON Web Token (JWT) for authentication (RFC 7516). HTTP methods:
                        GET/POST/PUT/DELETE. API modules: Authentication, User Management, Advertisement Management,
                        Transactions. Load testing via Loader.io. JSON (RFC 8259) as data interchange format.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Iterative model reduces integration risk vs. waterfall. REST API decouples
                        frontend (Vue.js/mobile) from backend, enabling parallel development and independent scaling.
                        Load testing results confirm stable CPU usage under concurrent requests. JSON+JWT adds minimal
                        overhead while providing stateless, scalable authentication.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">REST API Design</span>
                        <span class="attr-tag">JWT Authentication</span>
                        <span class="attr-tag">Digital Advertising</span>
                        <span class="attr-tag">Load Testing</span>
                        <span class="attr-tag">Iterative Development</span>
                        <span class="attr-tag">JSON API</span>
                        <span class="attr-tag">Multi-Platform</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 18 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">18</div>
                <div class="paper-title-block">
                    <h2>RESTful API Testing Methodologies: Rationale, Challenges, and Solution Directions</h2>
                    <div class="paper-authors">Corradini, D. et al. (2022) — Applied Sciences, MDPI 12(9), 4369</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2022</span>
                        <span class="tag tag-api">Web API</span>
                        <span class="source-badge">MDPI · CC BY 4.0</span>
                    </div>
                </div>
                <a class="card-link" href="https://www.mdpi.com/2076-3417/12/9/4369" target="_blank">Full Text</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Systematic Literature Review (SLR) of RESTful API testing techniques:
                        specification-based, fuzzing, model-based, and constraint-solving approaches. Classification
                        framework for 50+ testing tools. Quality scoring applied to selected papers. Analysis of testing
                        challenges: undocumented dependencies, dynamic behaviour, and state management.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Automated API testing reduces manual regression effort by orders of
                        magnitude. Specification-based testing (OpenAPI/Swagger) enables automated test generation.
                        Identifying and fixing API breaking changes early prevents service outages. Framework selection
                        matrix helps teams choose optimal testing approach for their architecture.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">API Testing</span>
                        <span class="attr-tag">OpenAPI / Swagger</span>
                        <span class="attr-tag">REST Architecture</span>
                        <span class="attr-tag">Automated Testing</span>
                        <span class="attr-tag">Service-Oriented Architecture</span>
                        <span class="attr-tag">Cloud Services</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ─── SECTION 6: SOCIAL MEDIA & CAMPAIGN ANALYTICS ─── -->
        <div class="section-divider"><span>§6 — Social Media &amp; Campaign Analytics</span></div>

        <!-- PAPER 19 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">19</div>
                <div class="paper-title-block">
                    <h2>Social Media Analytics: A Survey of Techniques, Tools and Platforms</h2>
                    <div class="paper-authors">McCreadie, R. et al. / Batrinca, B. &amp; Treleaven, P. C. (2015) — AI
                        &amp; Society, Springer</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2015</span>
                        <span class="tag tag-social">Social &amp; Campaign</span>
                        <span class="source-badge">Springer · Open Access PDF</span>
                    </div>
                </div>
                <a class="card-link" href="https://link.springer.com/article/10.1007/s00146-014-0549-4"
                    target="_blank">Full Text</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Taxonomy-based survey of 30+ social media analytics tools across four
                        layers: data collection (API scraping), processing (ETL, cleansing), analysis (sentiment,
                        network), and visualization (dashboards). Presents full system architecture of a UCL social
                        media analytics platform. Tools reviewed include Sysomos, Radian6, Brandwatch, Crimson Hexagon.
                    </div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">Web-based API data collection scales to millions of posts without local
                        storage. Holistic multi-source ingestion (social + market + geospatial data) provides richer
                        analytics context. UCL platform architecture demonstrates how to build a scalable social
                        analytics pipeline using standard web technologies and open APIs.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">Social Media APIs</span>
                        <span class="attr-tag">Sentiment Analysis</span>
                        <span class="attr-tag">Platform Architecture</span>
                        <span class="attr-tag">Brand Monitoring</span>
                        <span class="attr-tag">Network Analysis</span>
                        <span class="attr-tag">Analytics Dashboard</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAPER 20 -->
        <div class="paper-card">
            <div class="card-header">
                <div class="paper-num">20</div>
                <div class="paper-title-block">
                    <h2>Big Data Analytics in Business for Marketing Research: A Retrospective of Domain and Knowledge
                        Structure</h2>
                    <div class="paper-authors">Multiple Authors (2025) — Procedia Computer Science / ScienceDirect</div>
                    <div class="paper-meta-line">
                        <span class="year-badge">2025</span>
                        <span class="tag tag-social">Social &amp; Campaign</span>
                        <span class="tag tag-bi">Business Intelligence</span>
                        <span class="source-badge">ScienceDirect · Open Access</span>
                    </div>
                </div>
                <a class="card-link" href="https://www.sciencedirect.com/science/article/pii/S1877050925027516"
                    target="_blank">Full Text</a>
            </div>
            <div class="card-body">
                <div class="detail-cell">
                    <div class="detail-label dl-algo">Algorithm / Methodology</div>
                    <div class="detail-text">Bibliometric analysis (2012–2023) using Scopus database + VOSviewer for
                        knowledge mapping. Identifies four development phases of BDA in marketing. Cluster analysis of
                        research themes: digital marketing, data privacy, customer analytics, and AI-assisted
                        decision-making. Citation network and co-authorship mapping.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-eff">System Efficiency</div>
                    <div class="detail-text">VOSviewer cluster analysis processes 1000+ papers in minutes, revealing
                        research gaps efficiently. Identifies that data-driven digital marketing strategies (BDA)
                        improve campaign ROI through better customer targeting and segmentation. Provides roadmap for
                        ethical, sustainable BDA implementation compliant with GDPR and data privacy frameworks.</div>
                </div>
                <div class="detail-cell">
                    <div class="detail-label dl-attr">Key Attributes</div>
                    <div class="attr-tags">
                        <span class="attr-tag">Big Data Analytics</span>
                        <span class="attr-tag">Digital Marketing</span>
                        <span class="attr-tag">Bibliometric Analysis</span>
                        <span class="attr-tag">Customer Segmentation</span>
                        <span class="attr-tag">Data Privacy / Ethics</span>
                        <span class="attr-tag">Marketing ROI</span>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /content -->

    <footer>
        <p>📄 <strong>MarketMind AI</strong> — FYP Literature Review | 20 Papers | Google Scholar Indexed | All Open
            Access</p>
        <p>Stack Alignment: <strong>Vue.js + Laravel + MySQL + REST API</strong> | Compiled April 2026</p>
    </footer>

</body>

</html>