<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Black World — Intelligence Platform</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@300;400;500;600;700&family=Geist+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<style>
/* ═══════════════════════════════════════════
   TOKENS
═══════════════════════════════════════════ */
:root {
  /* Gold palette */
  --gold-50:  #fffbeb;
  --gold-200: #fde68a;
  --gold-400: #fbbf24;
  --gold-500: #f59e0b;
  --gold-600: #d97706;
  --gold-700: #b45309;

  /* Charcoal / surface */
  --surface-0: #0e0d0b;   /* page bg */
  --surface-1: #141210;   /* card bg */
  --surface-2: #1c1916;   /* elevated */
  --surface-3: #242018;   /* input bg */
  --surface-4: #2e2920;   /* hover */

  /* Borders */
  --border-subtle:  rgba(255,255,255,0.055);
  --border-default: rgba(255,255,255,0.09);
  --border-strong:  rgba(251,191,36,0.28);

  /* Text */
  --text-primary:   #f5f0e8;
  --text-secondary: #9d9082;
  --text-muted:     #5a5248;

  /* Glow */
  --glow-gold:  rgba(251,191,36,0.18);
  --glow-goldsm:rgba(251,191,36,0.08);

  /* Typography */
  --font-serif: 'Instrument Serif', Georgia, serif;
  --font-sans:  'Geist', system-ui, sans-serif;
  --font-mono:  'Geist Mono', monospace;

  /* Misc */
  --radius:    12px;
  --radius-lg: 18px;
  --radius-xl: 24px;
  --ease: cubic-bezier(.16,1,.3,1);
  --tr: 0.18s ease;
}

/* Light mode */
body.light {
  --surface-0: #faf8f4;
  --surface-1: #ffffff;
  --surface-2: #f4f1eb;
  --surface-3: #edeae2;
  --surface-4: #e4e0d6;
  --border-subtle:  rgba(0,0,0,0.05);
  --border-default: rgba(0,0,0,0.09);
  --border-strong:  rgba(180,83,9,0.25);
  --text-primary:   #1a1610;
  --text-secondary: #6b6055;
  --text-muted:     #a89880;
  --glow-gold:  rgba(217,119,6,0.12);
  --glow-goldsm:rgba(217,119,6,0.05);
  --gold-400: #d97706;
  --gold-500: #b45309;
  --gold-600: #92400e;
}

/* ═══════════════════════════════════════════
   RESET & BASE
═══════════════════════════════════════════ */
*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
html { scroll-behavior:smooth; -webkit-font-smoothing:antialiased; }

body {
  font-family: var(--font-sans);
  background: var(--surface-0);
  color: var(--text-primary);
  min-height: 100vh;
  overflow-x: hidden;
  transition: background .4s var(--ease), color .4s var(--ease);
}

/* ── Noise grain overlay ── */
body::after {
  content: '';
  position: fixed; inset: 0; z-index: 9999;
  pointer-events: none;
  opacity: .028;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
  background-size: 200px 200px;
}
body.light::after { opacity:.018; }

/* ── Ambient gradient orb ── */
.orb {
  position: fixed; pointer-events: none; z-index: 0;
  border-radius: 50%;
  filter: blur(80px);
}
.orb-1 {
  width: 600px; height: 400px;
  top: -120px; left: 50%; transform: translateX(-50%);
  background: radial-gradient(ellipse, rgba(251,191,36,0.07) 0%, transparent 70%);
}
.orb-2 {
  width: 300px; height: 300px;
  bottom: 10%; right: 5%;
  background: radial-gradient(ellipse, rgba(217,119,6,0.05) 0%, transparent 70%);
}

/* ═══════════════════════════════════════════
   NAVBAR
═══════════════════════════════════════════ */
.navbar {
  position: fixed; top:0; left:0; right:0; z-index: 800;
  height: 56px;
  display: flex; align-items: center;
  padding: 0 20px;
  background: rgba(14,13,11,0.82);
  backdrop-filter: blur(20px) saturate(1.4);
  -webkit-backdrop-filter: blur(20px) saturate(1.4);
  border-bottom: 1px solid var(--border-subtle);
  transition: background .3s;
}
body.light .navbar { background: rgba(250,248,244,0.88); }

.nav-inner {
  max-width: 680px; margin: 0 auto; width: 100%;
  display: flex; align-items: center; gap: 12px;
}

/* Logo */
.nav-brand {
  display: flex; align-items: center; gap: 9px;
  text-decoration: none; margin-right: auto;
  flex-shrink: 0;
}
.brand-mark {
  width: 30px; height: 30px; border-radius: 8px;
  background: linear-gradient(135deg, var(--gold-700), var(--gold-400));
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 0 16px var(--glow-gold);
  overflow: hidden; flex-shrink: 0;
}
.brand-mark img { width:100%; height:100%; object-fit:cover; border-radius:7px; }
.brand-mark i { color:#0e0d0b; font-size:.85rem; }
.brand-name {
  font-family: var(--font-sans);
  font-size: .9rem; font-weight: 600;
  color: var(--text-primary);
  letter-spacing: .3px;
}
.brand-name span {
  display: block;
  font-size: .58rem; font-weight: 400;
  color: var(--text-muted);
  letter-spacing: 1.8px;
  text-transform: uppercase;
  font-family: var(--font-mono);
}

/* Theme pill */
.theme-pill {
  display: flex; align-items: center;
  background: var(--surface-2);
  border: 1px solid var(--border-subtle);
  border-radius: 50px; padding: 3px; gap: 1px;
}
.tp-btn {
  width: 28px; height: 28px; border-radius: 50%;
  border: none; background: transparent;
  color: var(--text-muted); cursor: pointer;
  font-size: .78rem;
  display: flex; align-items: center; justify-content: center;
  transition: all var(--tr);
}
.tp-btn.active {
  background: var(--gold-600);
  color: #fff;
  box-shadow: 0 0 10px var(--glow-gold);
}

/* Hamburger */
.ham {
  width: 34px; height: 34px; border-radius: 8px;
  background: var(--surface-2);
  border: 1px solid var(--border-subtle);
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  gap: 4px; cursor: pointer;
  transition: all var(--tr);
}
.ham:hover { border-color: var(--border-strong); }
.ham span {
  display: block; width: 14px; height: 1.5px;
  background: var(--text-secondary); border-radius: 2px;
  transition: all .25s var(--ease);
}
.ham.open span:nth-child(1) { transform: translateY(5.5px) rotate(45deg); background: var(--gold-400); }
.ham.open span:nth-child(2) { opacity:0; transform:scaleX(0); }
.ham.open span:nth-child(3) { transform: translateY(-5.5px) rotate(-45deg); background: var(--gold-400); }

/* ── Drawer ── */
.drawer-mask {
  position: fixed; inset:0;
  background: rgba(0,0,0,.55);
  backdrop-filter: blur(6px);
  z-index: 790; opacity:0; pointer-events:none;
  transition: opacity .25s;
}
.drawer-mask.open { opacity:1; pointer-events:all; }

.drawer {
  position: fixed; top:0; right:0;
  width: 252px; height:100vh;
  background: var(--surface-1);
  border-left: 1px solid var(--border-default);
  z-index: 795;
  transform: translateX(100%);
  transition: transform .32s var(--ease);
  padding: 64px 0 20px;
  display: flex; flex-direction: column;
}
.drawer.open { transform: translateX(0); }

.d-section-label {
  padding: 8px 18px 4px;
  font-size: .6rem; font-weight:500;
  letter-spacing: 2px; color: var(--text-muted);
  text-transform: uppercase; font-family: var(--font-mono);
}
.d-link {
  display: flex; align-items: center; gap: 11px;
  padding: 11px 18px;
  color: var(--text-secondary);
  text-decoration: none; font-size: .85rem; font-weight:500;
  border-left: 2px solid transparent;
  transition: all var(--tr);
}
.d-link i { width:16px; text-align:center; font-size:.88rem; opacity:.7; }
.d-link:hover {
  color: var(--gold-400);
  border-left-color: var(--gold-500);
  background: var(--glow-goldsm);
}
.d-sep { height:1px; background: var(--border-subtle); margin: 10px 18px; }

/* ═══════════════════════════════════════════
   PAGE LAYOUT
═══════════════════════════════════════════ */
.page {
  max-width: 640px;
  margin: 0 auto;
  padding: 72px 20px 60px;
  position: relative; z-index: 1;
}

/* ═══════════════════════════════════════════
   HERO
═══════════════════════════════════════════ */
.hero {
  padding: 52px 0 44px;
  text-align: center;
}
.hero-eyebrow {
  display: inline-flex; align-items: center; gap: 7px;
  padding: 4px 12px;
  border: 1px solid var(--border-strong);
  border-radius: 50px;
  background: var(--glow-goldsm);
  font-family: var(--font-mono);
  font-size: .62rem; letter-spacing: 2px;
  color: var(--gold-500);
  margin-bottom: 24px;
}
.status-dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--gold-400);
  box-shadow: 0 0 8px var(--gold-400);
  animation: pulse-ring 1.6s ease-in-out infinite;
}
@keyframes pulse-ring {
  0%,100% { box-shadow: 0 0 4px var(--gold-400); }
  50%      { box-shadow: 0 0 12px var(--gold-400), 0 0 24px rgba(251,191,36,.3); }
}

.hero-title {
  font-family: var(--font-serif);
  font-size: clamp(2.4rem, 7vw, 3.8rem);
  font-weight: 400;
  line-height: 1.06;
  color: var(--text-primary);
  margin-bottom: 16px;
  letter-spacing: -.5px;
}
.hero-title em {
  font-style: italic;
  background: linear-gradient(135deg, var(--gold-400), var(--gold-600));
  -webkit-background-clip: text; background-clip: text;
  color: transparent;
}

.hero-sub {
  font-size: .88rem;
  color: var(--text-secondary);
  line-height: 1.65;
  max-width: 420px;
  margin: 0 auto;
  font-weight: 400;
}

/* ═══════════════════════════════════════════
   DIVIDER
═══════════════════════════════════════════ */
.divider {
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--border-default), transparent);
  margin: 0 0 32px;
}

/* ═══════════════════════════════════════════
   SEARCH CARD
═══════════════════════════════════════════ */
.search-card {
  background: var(--surface-1);
  border: 1px solid var(--border-default);
  border-radius: var(--radius-xl);
  padding: 28px 26px;
  margin-bottom: 20px;
  position: relative; overflow: hidden;
  box-shadow:
    0 1px 0 rgba(255,255,255,.04) inset,
    0 0 0 1px var(--border-subtle) inset,
    0 20px 60px rgba(0,0,0,.35);
  transition: border-color .22s, box-shadow .22s;
}
.search-card:focus-within {
  border-color: var(--border-strong);
  box-shadow:
    0 1px 0 rgba(255,255,255,.04) inset,
    0 0 0 1px var(--border-subtle) inset,
    0 20px 60px rgba(0,0,0,.35),
    0 0 0 3px var(--glow-goldsm);
}
/* top shimmer line */
.search-card::before {
  content:'';
  position:absolute; top:0; left:15%; right:15%; height:1px;
  background: linear-gradient(90deg, transparent, var(--gold-600), transparent);
  opacity:.4;
}

.card-header {
  display: flex; align-items: center; gap: 11px;
  margin-bottom: 22px;
}
.card-icon-wrap {
  width: 38px; height: 38px; border-radius: 10px;
  background: var(--glow-goldsm);
  border: 1px solid var(--border-strong);
  display: flex; align-items: center; justify-content: center;
  color: var(--gold-400); font-size: .92rem;
  flex-shrink: 0;
}
.card-label { font-size: .9rem; font-weight: 600; color: var(--text-primary); }
.card-sublabel {
  font-size: .72rem; color: var(--text-muted);
  font-family: var(--font-mono); letter-spacing: 1px;
}

/* Input */
.input-wrapper { position: relative; margin-bottom: 14px; }
.input-prefix-icon {
  position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
  color: var(--text-muted); font-size: .85rem; pointer-events: none;
  transition: color .18s;
}
.search-input {
  width: 100%;
  padding: 13px 14px 13px 42px;
  background: var(--surface-3);
  border: 1px solid var(--border-default);
  border-radius: var(--radius);
  font-family: var(--font-mono);
  font-size: .95rem;
  color: var(--text-primary);
  outline: none;
  transition: all .18s;
  letter-spacing: .5px;
}
.search-input::placeholder { color: var(--text-muted); font-size:.82rem; letter-spacing:.5px; }
.search-input:focus {
  border-color: var(--gold-700);
  background: var(--surface-4);
  box-shadow: 0 0 0 3px var(--glow-goldsm);
}
.input-wrapper:focus-within .input-prefix-icon { color: var(--gold-500); }

/* Button */
.search-btn {
  width: 100%;
  padding: 13px 20px;
  background: linear-gradient(160deg, var(--gold-600) 0%, var(--gold-700) 100%);
  border: 1px solid var(--gold-700);
  border-radius: var(--radius);
  color: #fff;
  font-family: var(--font-sans);
  font-size: .9rem; font-weight: 600;
  letter-spacing: .3px;
  cursor: pointer;
  position: relative; overflow: hidden;
  transition: all .2s var(--ease);
  box-shadow: 0 1px 0 rgba(255,255,255,.12) inset, 0 4px 16px var(--glow-gold);
}
.search-btn::before {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(160deg, rgba(255,255,255,.08) 0%, transparent 60%);
  pointer-events: none;
}
.search-btn:hover {
  transform: translateY(-1px);
  box-shadow: 0 1px 0 rgba(255,255,255,.12) inset, 0 8px 28px var(--glow-gold);
}
.search-btn:active { transform: translateY(0); }
.search-btn i { margin-right: 7px; font-size: .85rem; }

/* ═══════════════════════════════════════════
   RESULTS
═══════════════════════════════════════════ */
.results-section { display:none; margin-bottom: 20px; }

.results-card {
  background: var(--surface-1);
  border: 1px solid var(--border-default);
  border-radius: var(--radius-xl);
  padding: 24px 24px 20px;
  position: relative; overflow: hidden;
  box-shadow:
    0 1px 0 rgba(255,255,255,.04) inset,
    0 20px 60px rgba(0,0,0,.35);
}
.results-card::before {
  content:'';
  position:absolute; top:0; left:15%; right:15%; height:1px;
  background: linear-gradient(90deg, transparent, var(--gold-600), transparent);
  opacity:.35;
}

.results-topbar {
  display: flex; justify-content: space-between; align-items: center;
  margin-bottom: 20px;
  padding-bottom: 16px;
  border-bottom: 1px solid var(--border-subtle);
}
.results-title-group {
  display: flex; align-items: center; gap: 10px;
}
.results-title-group h3 {
  font-size: .88rem; font-weight: 600; color: var(--text-primary);
}
.live-badge {
  display: inline-flex; align-items: center; gap: 5px;
  padding: 2px 9px;
  background: rgba(251,191,36,.08);
  border: 1px solid var(--border-strong);
  border-radius: 50px;
  font-family: var(--font-mono);
  font-size: .58rem; letter-spacing: 2px;
  color: var(--gold-500);
}
.live-badge::before {
  content:'';
  width: 5px; height: 5px; border-radius: 50%;
  background: var(--gold-400);
  box-shadow: 0 0 6px var(--gold-400);
  flex-shrink: 0;
  animation: pulse-ring 1.6s ease-in-out infinite;
}
.action-row { display:flex; gap:8px; }
.action-btn {
  display: flex; align-items: center; gap: 6px;
  padding: 7px 13px;
  background: var(--surface-2);
  border: 1px solid var(--border-subtle);
  border-radius: 8px;
  color: var(--text-secondary);
  font-size: .78rem; font-weight: 500;
  cursor: pointer;
  transition: all var(--tr);
}
.action-btn:hover { border-color: var(--border-strong); color: var(--gold-400); }

/* ── Data boxes ── */
.data-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
}
@media (max-width:520px) { .data-grid { grid-template-columns:1fr; } }

.data-box {
  background: var(--surface-2);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius);
  padding: 16px;
  position: relative;
  transition: border-color .18s, transform .18s;
}
.data-box:hover { border-color: var(--border-strong); transform: translateY(-1px); }
.data-box.span-full { grid-column: 1 / -1; }

/* Left accent stripe */
.data-box::before {
  content:'';
  position:absolute; top:14px; bottom:14px; left:0; width:2px;
  background: linear-gradient(180deg, var(--gold-500), transparent);
  border-radius: 0 2px 2px 0;
  opacity:.5;
}

.box-heading {
  display: flex; align-items: center; gap: 8px;
  margin-bottom: 14px;
  font-size: .68rem; font-weight: 600;
  text-transform: uppercase; letter-spacing: 1.5px;
  color: var(--text-muted);
}
.box-heading i { color: var(--gold-500); font-size: .8rem; }

.field { margin-bottom: 12px; }
.field:last-child { margin-bottom: 0; }
.field-label {
  display: block;
  font-size: .58rem; font-weight: 500;
  letter-spacing: 1.5px; text-transform: uppercase;
  color: var(--text-muted);
  font-family: var(--font-mono);
  margin-bottom: 4px;
}
.field-value {
  font-size: .96rem; font-weight: 600;
  color: var(--text-primary);
  word-break: break-all; line-height: 1.38;
}
.field-value.accent {
  color: var(--gold-400);
  font-family: var(--font-mono);
}

/* SIM list */
.sim-scroll {
  display: flex; flex-direction: column; gap: 7px;
  max-height: 240px; overflow-y: auto;
}
.sim-scroll::-webkit-scrollbar { width: 3px; }
.sim-scroll::-webkit-scrollbar-track { background: var(--surface-3); }
.sim-scroll::-webkit-scrollbar-thumb { background: var(--gold-700); border-radius: 3px; }

.sim-row {
  display: flex; align-items: center; justify-content: space-between;
  padding: 10px 13px;
  background: var(--surface-3);
  border: 1px solid var(--border-subtle);
  border-radius: 9px;
  transition: all var(--tr);
}
.sim-row:hover { border-color: var(--border-strong); background: var(--surface-4); }
.sim-number { font-family: var(--font-mono); font-size: .92rem; color: var(--text-primary); }
.sim-pill {
  font-family: var(--font-mono); font-size: .58rem; letter-spacing: 1.5px;
  background: rgba(251,191,36,.07);
  border: 1px solid var(--border-strong);
  color: var(--gold-500);
  padding: 2px 9px; border-radius: 50px;
}

/* Result footer */
.result-footer {
  margin-top: 16px; padding-top: 14px;
  border-top: 1px solid var(--border-subtle);
  display: flex; justify-content: space-between; align-items: center;
  flex-wrap: wrap; gap: 8px;
}
.result-footer span {
  font-family: var(--font-mono);
  font-size: .62rem; color: var(--text-muted); letter-spacing: .8px;
}
.result-footer .brand-accent { color: var(--gold-500); }

/* ── State views ── */
.state-view {
  display: flex; flex-direction: column; align-items: center;
  padding: 40px 20px; text-align: center; gap: 10px;
}
.state-icon {
  width: 52px; height: 52px; border-radius: 14px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.3rem; margin-bottom: 6px;
}
.state-icon.loading {
  background: var(--glow-goldsm);
  border: 1px solid var(--border-strong);
  color: var(--gold-400);
}
.state-icon.empty  { background: var(--surface-3); border:1px solid var(--border-subtle); color: var(--text-muted); }
.state-icon.error  { background: rgba(239,68,68,.08); border:1px solid rgba(239,68,68,.2); color:#f87171; }
.state-icon.premium{ background: rgba(251,191,36,.07); border:1px solid var(--border-strong); color:var(--gold-400); }

.state-title { font-size: .95rem; font-weight: 600; color: var(--text-primary); }
.state-desc  { font-size: .84rem; color: var(--text-secondary); max-width:300px; line-height:1.55; }

.spin { animation: spin .7s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }

/* ═══════════════════════════════════════════
   SERVICES SECTION
═══════════════════════════════════════════ */
.section-title-row {
  display: flex; align-items: center; gap: 14px;
  margin-bottom: 16px;
}
.section-title-row h2 {
  font-family: var(--font-serif);
  font-size: 1.4rem; font-weight: 400;
  color: var(--text-primary); white-space: nowrap;
  letter-spacing: -.2px;
}
.title-line {
  flex:1; height:1px;
  background: linear-gradient(90deg, var(--border-default), transparent);
}

.services-grid {
  display: grid;
  grid-template-columns: repeat(3,1fr);
  gap: 11px;
  margin-bottom: 28px;
}
@media(max-width:500px){ .services-grid { grid-template-columns:1fr; } }

.service-tile {
  background: var(--surface-1);
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius);
  padding: 18px 15px;
  transition: all .2s var(--ease);
  position: relative; overflow: hidden;
}
.service-tile::after {
  content:'';
  position:absolute; bottom:0; left:0; right:0; height:2px;
  background: linear-gradient(90deg, transparent, var(--gold-600), transparent);
  opacity:0; transition: opacity .2s;
}
.service-tile:hover {
  border-color: var(--border-strong);
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(0,0,0,.25);
}
.service-tile:hover::after { opacity:.5; }

.service-ic {
  width: 34px; height: 34px; border-radius: 9px;
  background: var(--glow-goldsm);
  border: 1px solid var(--border-strong);
  display: flex; align-items: center; justify-content: center;
  color: var(--gold-400); font-size: .85rem;
  margin-bottom: 12px;
}
.service-name { font-size:.82rem; font-weight:600; color:var(--text-primary); margin-bottom:5px; }
.service-desc { font-size:.78rem; color:var(--text-secondary); line-height:1.55; }

/* ═══════════════════════════════════════════
   CONTACT
═══════════════════════════════════════════ */
.contact-card {
  background: var(--surface-1);
  border: 1px solid var(--border-default);
  border-radius: var(--radius-xl);
  padding: 26px;
  text-align: center;
  margin-bottom: 28px;
  position: relative; overflow: hidden;
}
.contact-card::before {
  content:'';
  position:absolute; top:0; left:15%; right:15%; height:1px;
  background: linear-gradient(90deg, transparent, var(--gold-600), transparent);
  opacity:.35;
}
.contact-card h2 {
  font-family: var(--font-serif);
  font-size: 1.35rem; font-weight:400;
  color: var(--text-primary); margin-bottom:6px;
  letter-spacing:-.2px;
}
.contact-card p { font-size:.84rem; color:var(--text-secondary); margin-bottom:18px; }

.contact-links { display:flex; gap:9px; justify-content:center; flex-wrap:wrap; }
.contact-link {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 9px 18px;
  background: var(--surface-2);
  border: 1px solid var(--border-default);
  border-radius: 50px;
  color: var(--text-secondary);
  font-size: .83rem; font-weight:500;
  text-decoration: none;
  transition: all var(--tr);
}
.contact-link i { font-size:.9rem; }
.contact-link:hover {
  border-color: var(--border-strong);
  color: var(--gold-400);
  background: var(--glow-goldsm);
  transform: translateY(-1px);
}

/* ═══════════════════════════════════════════
   FOOTER
═══════════════════════════════════════════ */
footer {
  text-align: center;
  border-top: 1px solid var(--border-subtle);
  padding: 22px 20px;
  font-family: var(--font-mono);
  font-size: .62rem; letter-spacing:1.5px;
  color: var(--text-muted);
  position: relative; z-index:1;
}

/* ═══════════════════════════════════════════
   JOIN POPUP
═══════════════════════════════════════════ */
.popup-overlay {
  position: fixed; inset:0;
  background: rgba(0,0,0,.72);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  z-index: 1000;
  display: flex; align-items: center; justify-content: center;
  animation: fade-in .3s ease;
}
@keyframes fade-in { from{opacity:0} to{opacity:1} }

.popup-box {
  background: var(--surface-1);
  border: 1px solid var(--border-strong);
  border-radius: var(--radius-xl);
  padding: 36px 28px;
  max-width: 360px; width: 92%;
  text-align: center;
  box-shadow:
    0 1px 0 rgba(255,255,255,.05) inset,
    0 40px 80px rgba(0,0,0,.6),
    0 0 60px var(--glow-goldsm);
  animation: pop-in .36s var(--ease);
  position: relative; overflow:hidden;
}
.popup-box::before {
  content:'';
  position:absolute; top:0; left:10%; right:10%; height:1px;
  background: linear-gradient(90deg, transparent, var(--gold-500), transparent);
  opacity:.5;
}
@keyframes pop-in {
  from { transform:scale(.9) translateY(8px); opacity:0; }
  to   { transform:scale(1) translateY(0);    opacity:1; }
}
.popup-glyph {
  width: 58px; height: 58px; border-radius:16px;
  background: var(--glow-goldsm);
  border: 1px solid var(--border-strong);
  display: flex; align-items:center; justify-content:center;
  margin: 0 auto 18px;
  font-size: 1.45rem; color: var(--gold-400);
  box-shadow: 0 0 20px var(--glow-gold);
}
.popup-title {
  font-family: var(--font-serif);
  font-size: 1.5rem; font-weight:400;
  color: var(--text-primary);
  margin-bottom: 9px; letter-spacing:-.2px;
}
.popup-desc {
  font-size: .85rem; color: var(--text-secondary);
  line-height: 1.65; margin-bottom: 22px;
}
.popup-cta {
  display: flex; align-items:center; justify-content:center; gap:9px;
  width:100%; padding:13px;
  background: linear-gradient(160deg, var(--gold-600), var(--gold-700));
  border: 1px solid var(--gold-700);
  border-radius: var(--radius);
  color: #fff;
  font-size:.9rem; font-weight:600;
  text-decoration:none; cursor:pointer;
  box-shadow: 0 1px 0 rgba(255,255,255,.1) inset, 0 4px 16px var(--glow-gold);
  transition: all .2s var(--ease);
  margin-bottom: 10px;
}
.popup-cta:hover { transform:translateY(-1px); box-shadow:0 1px 0 rgba(255,255,255,.1) inset, 0 8px 24px var(--glow-gold); }
.popup-dismiss {
  width:100%; padding:10px;
  background:transparent;
  border: 1px solid var(--border-subtle);
  border-radius: var(--radius);
  color: var(--text-muted);
  font-size:.82rem; cursor:pointer;
  transition:all var(--tr);
}
.popup-dismiss:hover { border-color:var(--border-default); color:var(--text-secondary); }

/* ═══════════════════════════════════════════
   TOAST
═══════════════════════════════════════════ */
.toast-wrap {
  position: fixed; top:68px; right:16px; z-index:900;
  display: flex; flex-direction:column; gap:8px;
  pointer-events:none;
}
.toast {
  padding: 11px 16px;
  border-radius: 10px;
  font-size: .82rem; font-weight:500;
  display: flex; align-items:center; gap:9px;
  max-width: 264px;
  transform: translateX(calc(100% + 24px));
  transition: transform .28s var(--ease);
  pointer-events:none;
}
.toast.show { transform:translateX(0); }
.toast.success { background:#0f1f12; border:1px solid #22c55e; color:#4ade80; }
.toast.error   { background:#200d0d; border:1px solid #ef4444; color:#f87171; }
.toast.info    { background:var(--surface-2); border:1px solid var(--border-strong); color:var(--gold-400); }

/* ── Premium buy button (inline) ── */
.buy-btn {
  display: inline-flex; align-items:center; gap:8px;
  margin-top:16px; padding:9px 18px;
  background: rgba(251,191,36,.07);
  border: 1px solid var(--border-strong);
  border-radius:50px;
  color:var(--gold-400); font-size:.82rem; font-weight:600;
  text-decoration:none;
  transition:all var(--tr);
}
.buy-btn:hover { background:rgba(251,191,36,.12); transform:translateY(-1px); }

/* Scrollbar global */
::-webkit-scrollbar { width:4px; }
::-webkit-scrollbar-track { background:var(--surface-0); }
::-webkit-scrollbar-thumb { background:var(--surface-4); border-radius:4px; }
</style>
</head>
<body>

<!-- Ambient orbs -->
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>

<!-- ════════════════════════════════
     JOIN POPUP
════════════════════════════════ -->
<div class="popup-overlay" id="joinPopup">
  <div class="popup-box">
    <div class="popup-glyph"><i class="fab fa-whatsapp"></i></div>
    <div class="popup-title">Join Our Channel</div>
    <p class="popup-desc">Stay ahead — get instant updates on new tools, data access & exclusive features.</p>
    <a href="https://whatsapp.com/channel/0029Vb6suqa0wajjJykf9w0x" target="_blank" class="popup-cta">
      <i class="fab fa-whatsapp"></i> Join Now — It's Free
    </a>
    <button class="popup-dismiss" onclick="closePopup()">Maybe later</button>
  </div>
</div>

<!-- ════════════════════════════════
     NAVBAR
════════════════════════════════ -->
<nav class="navbar">
  <div class="nav-inner">

    <a href="#" class="nav-brand">
      <div class="brand-mark">
        <img src="https://ibb.co/tW7rNkr" alt="Logo"
             onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
        <i class="fas fa-bolt" style="display:none"></i>
      </div>
      <div class="brand-name">
        LEGEND RAZZ 
        <span>Intelligence Platform</span>
      </div>
    </a>

    <div class="theme-pill">
      <button class="tp-btn active" id="darkBtn" onclick="setTheme('dark')" title="Dark mode">
        <i class="fas fa-moon"></i>
      </button>
      <button class="tp-btn" id="lightBtn" onclick="setTheme('light')" title="Light mode">
        <i class="fas fa-sun"></i>
      </button>
    </div>

    <div class="ham" id="hamBtn" onclick="toggleDrawer()">
      <span></span><span></span><span></span>
    </div>

  </div>
</nav>

<!-- ════════════════════════════════
     DRAWER
════════════════════════════════ -->
<div class="drawer-mask" id="drawerMask" onclick="closeDrawer()"></div>
<div class="drawer" id="sideDrawer">
  <div class="d-section-label">Navigate</div>
  <a href="#search-section" class="d-link" onclick="closeDrawer()">
    <i class="fas fa-search"></i> Search
  </a>
  <a href="#services-section" class="d-link" onclick="closeDrawer()">
    <i class="fas fa-layer-group"></i> Services
  </a>
  <a href="#contact-section" class="d-link" onclick="closeDrawer()">
    <i class="fas fa-headset"></i> Contact
  </a>
  <div class="d-sep"></div>
  <div class="d-section-label">Links</div>
  <a href="https://wa.me/923010441894" target="_blank" class="d-link">
    <i class="fab fa-whatsapp"></i> WhatsApp
  </a>
  <a href="https://whatsapp.com/channel/0029Vb6suqa0wajjJykf9w0x" target="_blank" class="d-link">
    <i class="fas fa-rss"></i> Channel
  </a>
  <a href="https://t.me/hackwithrazzl" target="_blank" class="d-link">
    <i class="fab fa-telegram"></i> Telegram
  </a>
</div>

<!-- ════════════════════════════════
     PAGE
════════════════════════════════ -->
<div class="page">

  <!-- HERO -->
  <section class="hero">
    <div class="hero-eyebrow">
      <div class="status-dot"></div>
      System Online — V1
    </div>
    <h1 class="hero-title">
      Pakistan's most<br>
      <em>intelligent</em> lookup
    </h1>
    <p class="hero-sub">
      Instant access to SIM registration data, CNIC records, and address details — all in one place.
    </p>
  </section>

  <div class="divider"></div>

  <!-- SEARCH -->
  <section id="search-section">
    <div class="search-card">
      <div class="card-header">
        <div class="card-icon-wrap"><i class="fas fa-database"></i></div>
        <div>
          <div class="card-label">Person Lookup</div>
          <div class="card-sublabel">Phone number or CNIC</div>
        </div>
      </div>

      <form id="searchForm" autocomplete="off">
        <div class="input-wrapper">
          <i class="fas fa-search input-prefix-icon"></i>
          <input
            type="text"
            class="search-input"
            id="searchInput"
            placeholder="0301041894 or 3010441894"
            maxlength="13"
          >
        </div>
        <button type="submit" class="search-btn">
          <i class="fas fa-arrow-right"></i> Retrieve Data
        </button>
      </form>
    </div>
  </section>

  <!-- RESULTS -->
  <section class="results-section" id="resultsSection">
    <div class="results-card">
      <div class="results-topbar">
        <div class="results-title-group">
          <h3>Retrieved Data</h3>
          <div class="live-badge">Live</div>
        </div>
        <div class="action-row">
          <button class="action-btn" id="saveBtn">
            <i class="fas fa-camera"></i> Save
          </button>
          <button class="action-btn" id="clearBtn">
            <i class="fas fa-xmark"></i> Clear
          </button>
        </div>
      </div>
      <div id="resultsContent"></div>
    </div>
  </section>

 
  <!-- CONTACT -->
  <section id="contact-section">
    <div class="contact-card">
      <h2>Get in Touch</h2>
      <p>Premium access, custom requests & technical support</p>
      <div class="contact-links">
        <a href="https://wa.me/923010441894" target="_blank" class="contact-link">
          <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="https://whatsapp.com/channel/0029Vb6suqa0wajjJykf9w0x" target="_blank" class="contact-link">
          <i class="fas fa-rss"></i> Channel
        </a>
        <a href="https://t.me/hackwithrazz" target="_blank" class="contact-link">
          <i class="fab fa-telegram"></i> Telegram
        </a>
      </div>
    </div>
  </section>

</div><!-- /page -->

<footer>
  All Rights Reserved HACK WITH RAZZ. Developed by LEGEND RAZZ
</footer>

<!-- Toast container -->
<div class="toast-wrap" id="toastWrap"></div>

<!-- ════════════════════════════════
     JAVASCRIPT
════════════════════════════════ -->
<script>
/* ── Init ── */
document.addEventListener('DOMContentLoaded', () => {
  setTimeout(() => {
    document.getElementById('joinPopup').style.display = 'flex';
  }, 900);

  initTheme();

  document.getElementById('searchInput').addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '').substring(0, 13);
  });

  document.getElementById('searchForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const q = document.getElementById('searchInput').value.trim();
    if (!q) { showToast('Enter a phone number or CNIC.', 'error'); return; }
    if (q.length < 10) { showToast('Enter 11-digit phone or 13-digit CNIC.', 'error'); return; }
    await doSearch(q);
  });

  document.getElementById('saveBtn').addEventListener('click', takeScreenshot);
  document.getElementById('clearBtn').addEventListener('click', clearResults);
});

/* ── Popup ── */
function closePopup() {
  const el = document.getElementById('joinPopup');
  el.style.opacity = '0';
  el.style.transition = 'opacity .22s';
  setTimeout(() => el.style.display = 'none', 220);
}

/* ── Drawer ── */
function toggleDrawer() {
  document.getElementById('sideDrawer').classList.toggle('open');
  document.getElementById('drawerMask').classList.toggle('open');
  document.getElementById('hamBtn').classList.toggle('open');
}
function closeDrawer() {
  document.getElementById('sideDrawer').classList.remove('open');
  document.getElementById('drawerMask').classList.remove('open');
  document.getElementById('hamBtn').classList.remove('open');
}

/* ── Theme ── */
function initTheme() {
  setTheme(localStorage.getItem('bw-theme') || 'dark');
}
function setTheme(t) {
  document.body.classList.toggle('light', t === 'light');
  document.getElementById('darkBtn').classList.toggle('active', t === 'dark');
  document.getElementById('lightBtn').classList.toggle('active', t === 'light');
  localStorage.setItem('bw-theme', t);
}

/* ── Search (UPDATED: using integrated API) ── */
async function doSearch(q) {
  const section  = document.getElementById('resultsSection');
  const content  = document.getElementById('resultsContent');
  section.style.display = 'block';
  setTimeout(() => section.scrollIntoView({ behavior: 'smooth', block: 'start' }), 80);

  content.innerHTML = stateView('loading',
    '<i class="fas fa-spinner spin"></i>',
    'Fetching records…',
    'Connecting to database'
  );

  try {
    // Call the same file (which now handles API requests) with number parameter
    const res = await fetch(`?number=${encodeURIComponent(q)}`);
    const json = await res.json();

    // Handle premium or error messages from the API
    if (json.success === false || (json.message && json.message.toLowerCase().includes('premium'))) {
      const msg = json.message || 'Premium subscription required.';
      showPremium(msg);
    } 
    else if (json.data && Array.isArray(json.data) && json.data.length > 0) {
      renderData(json.data);
      showToast('Records retrieved successfully.', 'success');
    } 
    else {
      content.innerHTML = stateView('empty',
        '<i class="fas fa-binoculars"></i>',
        'No records found',
        'No data matches the entered number or CNIC.'
      );
    }
  } catch (err) {
    console.error(err);
    content.innerHTML = stateView('error',
      '<i class="fas fa-triangle-exclamation"></i>',
      'Connection failed',
      'Could not reach the server. Check your internet connection and try again.'
    );
  }
}

function stateView(type, icon, title, desc) {
  return `<div class="state-view">
    <div class="state-icon ${type}">${icon}</div>
    <div class="state-title">${title}</div>
    <p class="state-desc">${desc}</p>
  </div>`;
}

function renderData(data) {
  const p      = data[0];
  const father = p.FatherName || p.Father_Name || p.father_name || p.fatherName || null;

  const simRows = data.map((d, i) => `
    <div class="sim-row">
      <span class="sim-number">${d.Mobile}</span>
      <span class="sim-pill">SIM ${String(i + 1).padStart(2, '0')}</span>
    </div>`).join('');

  document.getElementById('resultsContent').innerHTML = `
    <div class="data-grid">

      <div class="data-box">
        <div class="box-heading"><i class="fas fa-user"></i> Identity</div>
        <div class="field">
          <span class="field-label">Full Name</span>
          <div class="field-value">${p.Name || '—'}</div>
        </div>
        ${father ? `<div class="field">
          <span class="field-label">Father's Name</span>
          <div class="field-value">${father}</div>
        </div>` : ''}
        <div class="field">
          <span class="field-label">CNIC Number</span>
          <div class="field-value accent">${p.CNIC || '—'}</div>
        </div>
      </div>

      <div class="data-box">
        <div class="box-heading"><i class="fas fa-location-dot"></i> Address</div>
        <div class="field">
          <span class="field-label">Registered Address</span>
          <div class="field-value" style="font-size:.88rem; line-height:1.5;">${p.Address || '—'}</div>
        </div>
      </div>

      <div class="data-box span-full">
        <div class="box-heading">
          <i class="fas fa-sim-card"></i> Registered SIM Numbers
          <span style="margin-left:auto; background:rgba(251,191,36,.07); border:1px solid var(--border-strong); color:var(--gold-500); font-family:var(--font-mono); font-size:.58rem; letter-spacing:1.5px; padding:2px 10px; border-radius:50px;">
            ${data.length} total
          </span>
        </div>
        <div class="sim-scroll">${simRows}</div>
      </div>

    </div>

    <div class="result-footer">
      <span>Source: <span class="brand-accent">Black World</span> Database</span>
      <span>${new Date().toLocaleString()}</span>
    </div>`;
}

function showPremium(msg) {
  document.getElementById('resultsContent').innerHTML = `
    <div class="state-view">
      <div class="state-icon premium"><i class="fas fa-crown"></i></div>
      <div class="state-title">Premium required</div>
      <p class="state-desc">${msg}</p>
      <a href="https://wa.me/923058190234" target="_blank" class="buy-btn">
        <i class="fab fa-whatsapp"></i> Buy Premium Access
      </a>
    </div>`;
}

function clearResults() {
  document.getElementById('resultsSection').style.display = 'none';
  document.getElementById('resultsContent').innerHTML = '';
  document.getElementById('searchInput').value = '';
}

/* ── Screenshot ── */
function takeScreenshot() {
  const btn = document.getElementById('saveBtn');
  const orig = btn.innerHTML;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
  btn.disabled = true;
  html2canvas(document.getElementById('resultsSection'), {
    backgroundColor: getComputedStyle(document.body).backgroundColor,
    useCORS: true, scale: 2, logging: false
  }).then(canvas => {
    const a = document.createElement('a');
    a.download = `BW_${Date.now()}.png`;
    a.href = canvas.toDataURL('image/png');
    a.click();
    btn.innerHTML = '<i class="fas fa-check"></i> Saved';
    setTimeout(() => { btn.innerHTML = orig; btn.disabled = false; }, 2000);
  });
}

/* ── Toast ── */
function showToast(msg, type = 'info') {
  const wrap = document.getElementById('toastWrap');
  const t = document.createElement('div');
  t.className = `toast ${type}`;
  t.textContent = msg;
  wrap.appendChild(t);
  requestAnimationFrame(() => { requestAnimationFrame(() => t.classList.add('show')); });
 setTimeout(() => {
    t.classList.remove('show');
    setTimeout(() => t.remove(), 300);
  }, 3200);
}
</script>
<?php
// INTEGRATED API BACKEND (same file)
// Only executes when "number" parameter is present (AJAX request)
if (isset($_GET['number'])) {
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    
    $input = trim($_GET['number']);
    
    if (empty($input)) {
        echo json_encode(["success" => false, "message" => "Number parameter missing"]);
        exit;
    }
    
    // Normalize number: remove non-digits, remove leading zero
    $number = preg_replace('/[^0-9]/', '', $input);
    if (substr($number, 0, 1) === '0') {
        $number = substr($number, 1);
    }
    
    $ORIGINAL_API = "https://amscript.xyz/PublicApi/Siminfo.php?number=";
    $url = $ORIGINAL_API . urlencode($number);
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT        => 20,
        CURLOPT_USERAGENT      => 'Mozilla/5.0',
        CURLOPT_FOLLOWLOCATION => true,
    ]);
    
    $response = curl_exec($ch);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    if (!$response || $curlError) {
        echo json_encode(["success" => false, "message" => "CURL Failed: " . $curlError]);
        exit;
    }
    
    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(["success" => false, "message" => "Invalid API response"]);
        exit;
    }
    
    $res = $data['data'][0] ?? null;
    if (empty($res)) {
        echo json_encode(["success" => false, "message" => "No record found for $number"]);
        exit;
    }
    
    // Transform to match frontend expected structure: data array with objects containing Name, CNIC, Address, Mobile, FatherName (optional)
    $frontendData = [
        [
            "Name"      => $res['full_name'] ?? "Not Found",
            "CNIC"      => $res['cnic'] ?? "Not Found",
            "Address"   => $res['address'] ?? "Not Found",
            "Mobile"    => $res['phone'] ?? $number,
            "FatherName" => null   // API does not provide father name; kept null
        ]
    ];
    
    echo json_encode([
        "success" => true,
        "data"    => $frontendData
    ]);
    exit;
}
?>
</body>
</html>
```