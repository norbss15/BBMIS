<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>BBMIS – Pagamutan ng Dasmariñas</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,600;1,500;1,600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --green:#1F7A1F;--green-dark:#155215;--green-mid:#2E8B2E;--green-light:#7ED957;--green-tint:#F0FAF0;--green-border:#A8D5A8;
  --yellow:#FFD700;--yellow-tint:#FFFBEB;--yellow-dark:#B8960C;--yellow-border:#FDE68A;
  --red:#DC2626;--red-tint:#FEF2F2;--red-border:#FECACA;
  --blue:#2563EB;--blue-tint:#EFF6FF;--blue-border:#BFDBFE;
  --orange:#EA580C;--orange-tint:#FFF7ED;--orange-border:#FED7AA;
  --ink:#1A1A1A;--ink-2:#374151;--ink-3:#6B7280;--ink-4:#9CA3AF;
  --white:#FFFFFF;--bg:#F4F7F4;--line:#E5E7EB;
  --body:'Outfit',sans-serif;--serif:'Cormorant Garamond',serif;
}
html,body{height:100%;font-family:var(--body);background:var(--bg);color:var(--ink)}

/* ── PAGE SWITCHER (demo nav) ── */
.demo-nav{position:fixed;top:0;left:0;right:0;z-index:9999;background:var(--green-dark);padding:6px 12px;display:flex;gap:4px;flex-wrap:wrap;align-items:center}
.demo-nav span{font-size:10px;color:rgba(255,255,255,.5);margin-right:4px;font-weight:600;text-transform:uppercase;letter-spacing:.05em}
.demo-btn{font-size:11px;font-weight:600;padding:4px 10px;border-radius:6px;border:none;cursor:pointer;background:rgba(255,255,255,.12);color:#fff;transition:all .15s;font-family:var(--body)}
.demo-btn:hover{background:rgba(255,255,255,.22)}
.demo-btn.active{background:var(--green-light);color:var(--green-dark)}
body{padding-top:36px}

/* ── PAGES ── */
.page{display:none}
.page.active{display:flex;min-height:calc(100vh - 36px)}

/* ── SIDEBAR ── */
.sidebar{width:240px;min-width:240px;background:var(--green-dark);display:flex;flex-direction:column;position:sticky;top:36px;height:calc(100vh - 36px);overflow-y:auto}
.sb-brand{display:flex;align-items:center;gap:10px;padding:18px 16px;border-bottom:1px solid rgba(255,255,255,.1);text-decoration:none}
.sb-brand-icon{width:38px;height:38px;background:var(--green-light);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--green-dark);font-size:16px;font-weight:900;flex-shrink:0}
.sb-brand-text b{display:block;font-size:13.5px;font-weight:700;color:#fff}
.sb-brand-text small{font-size:10px;color:rgba(255,255,255,.4)}
.sb-section{padding:14px 10px 4px}
.sb-section-label{font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.3);padding:0 6px;display:block;margin-bottom:5px}
.sb-link{display:flex;align-items:center;gap:9px;padding:9px 10px;border-radius:8px;font-size:13px;color:rgba(255,255,255,.65);text-decoration:none;margin-bottom:2px;transition:all .15s;cursor:pointer}
.sb-link:hover{background:rgba(255,255,255,.1);color:#fff}
.sb-link.active{background:var(--green-light);color:var(--green-dark);font-weight:700}
.sb-link i{width:16px;text-align:center;font-size:13px}
.sb-badge{margin-left:auto;background:var(--yellow);color:var(--green-dark);font-size:10px;font-weight:700;padding:2px 7px;border-radius:10px}
.sb-link.active .sb-badge{background:var(--green-dark);color:var(--green-light)}
.sb-bottom{margin-top:auto;padding:14px 10px;border-top:1px solid rgba(255,255,255,.1)}
.sb-user{display:flex;align-items:center;gap:9px}
.sb-avatar{width:32px;height:32px;border-radius:50%;background:var(--green-light);color:var(--green-dark);font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center}
.sb-user-info b{display:block;font-size:12.5px;color:#fff}
.sb-user-info small{font-size:10.5px;color:rgba(255,255,255,.4)}
.sb-logout{margin-left:auto;color:rgba(255,255,255,.4);font-size:14px;cursor:pointer;transition:color .15s}
.sb-logout:hover{color:#fff}

/* ── MAIN ── */
.main{flex:1;display:flex;flex-direction:column}
.topbar{display:flex;align-items:center;justify-content:space-between;padding:12px 24px;background:var(--white);border-bottom:2px solid var(--green-border);position:sticky;top:36px;z-index:50}
.topbar-left{display:flex;align-items:center;gap:10px}
.topbar-title{font-size:15px;font-weight:700;color:var(--ink)}
.topbar-breadcrumb{font-size:12px;color:var(--ink-4)}
.topbar-right{display:flex;gap:8px;align-items:center}
.topbar-btn{width:36px;height:36px;border:1.5px solid var(--line);border-radius:9px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--ink-3);background:var(--white);position:relative;transition:all .15s}
.topbar-btn:hover{border-color:var(--green-border);color:var(--green);background:var(--green-tint)}
.notif-dot{position:absolute;top:5px;right:6px;width:7px;height:7px;background:var(--yellow);border-radius:50%;border:1.5px solid #fff}
.content{flex:1;padding:24px}

/* ── PAGE HEADER ── */
.page-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:22px}
.page-header h2{font-family:var(--serif);font-size:28px;font-style:italic;color:var(--green-dark)}
.page-header p{font-size:13px;color:var(--ink-4);margin-top:3px}

/* ── STAT CARDS ── */
.stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:20px}
.stat-card{background:var(--white);border:1px solid var(--line);border-radius:13px;padding:18px;display:flex;align-items:center;gap:14px;transition:all .2s;border-left:4px solid transparent}
.stat-card:hover{box-shadow:0 4px 16px rgba(31,122,31,0.1);transform:translateY(-1px)}
.stat-card.border-green{border-left-color:var(--green)}
.stat-card.border-yellow{border-left-color:var(--yellow)}
.stat-card.border-red{border-left-color:var(--red)}
.stat-card.border-blue{border-left-color:var(--blue)}
.stat-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:18px}
.si-green{background:var(--green-tint);color:var(--green)}
.si-yellow{background:var(--yellow-tint);color:var(--yellow-dark)}
.si-red{background:var(--red-tint);color:var(--red)}
.si-blue{background:var(--blue-tint);color:var(--blue)}
.si-orange{background:var(--orange-tint);color:var(--orange)}
.stat-val{font-size:26px;font-weight:700;color:var(--ink);line-height:1}
.stat-lbl{font-size:11.5px;color:var(--ink-4);margin-top:3px}
.stat-trend{font-size:11px;font-weight:600;margin-top:5px;display:flex;align-items:center;gap:3px}
.trend-up{color:var(--green)}.trend-down{color:var(--red)}.trend-warn{color:var(--yellow-dark)}

/* ── CARDS ── */
.card{background:var(--white);border:1px solid var(--line);border-radius:13px;overflow:hidden;margin-bottom:14px}
.card-head{display:flex;align-items:center;justify-content:space-between;padding:14px 20px;border-bottom:1px solid var(--line);background:#FAFCFA}
.card-head h3{font-size:14px;font-weight:700;color:var(--ink);display:flex;align-items:center;gap:7px}
.card-head h3 i{color:var(--green);font-size:13px}
.card-head p{font-size:11.5px;color:var(--ink-4);margin-top:2px}

/* ── BUTTONS ── */
.btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:9px;font-family:var(--body);font-size:13px;font-weight:500;cursor:pointer;border:none;transition:all .15s;text-decoration:none}
.btn-sm{padding:5px 11px;font-size:12px;border-radius:7px}
.btn-primary{background:var(--green);color:#fff}.btn-primary:hover{background:var(--green-dark)}
.btn-secondary{background:var(--green-light);color:var(--green-dark);font-weight:700}.btn-secondary:hover{filter:brightness(.92)}
.btn-warning{background:var(--yellow);color:var(--green-dark);font-weight:700}.btn-warning:hover{background:#E6C200}
.btn-outline{background:var(--white);color:var(--ink-2);border:1.5px solid var(--line)}.btn-outline:hover{border-color:var(--green);color:var(--green);background:var(--green-tint)}
.btn-danger{background:var(--red-tint);color:var(--red);border:1.5px solid var(--red-border)}.btn-danger:hover{background:var(--red);color:#fff}
.btn-approve{background:#DCFCE7;color:#15803D;border:1.5px solid #86EFAC;font-family:var(--body);font-size:12px;font-weight:600;padding:5px 11px;border-radius:7px;cursor:pointer;display:inline-flex;align-items:center;gap:5px;transition:all .15s}
.btn-approve:hover{background:#15803D;color:#fff}
.btn-reject{background:var(--red-tint);color:var(--red);border:1.5px solid var(--red-border);font-family:var(--body);font-size:12px;font-weight:600;padding:5px 11px;border-radius:7px;cursor:pointer;display:inline-flex;align-items:center;gap:5px;transition:all .15s}
.btn-reject:hover{background:var(--red);color:#fff}

/* ── BADGES ── */
.badge{font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;display:inline-block;white-space:nowrap}
.badge-green{background:var(--green-tint);color:var(--green);border:1px solid var(--green-border)}
.badge-yellow{background:var(--yellow-tint);color:var(--yellow-dark);border:1px solid var(--yellow-border)}
.badge-red{background:var(--red-tint);color:var(--red);border:1px solid var(--red-border)}
.badge-blue{background:var(--blue-tint);color:var(--blue);border:1px solid var(--blue-border)}
.badge-gray{background:#F3F4F6;color:var(--ink-3);border:1px solid #E5E7EB}
.badge-orange{background:var(--orange-tint);color:var(--orange);border:1px solid var(--orange-border)}

/* ── TABLE ── */
table{width:100%;border-collapse:collapse}
thead th{font-size:11px;font-weight:700;color:var(--ink-3);text-transform:uppercase;letter-spacing:.05em;padding:11px 16px;text-align:left;background:#F4F7F4;border-bottom:2px solid var(--green-border)}
tbody td{font-size:13px;color:var(--ink-2);padding:11px 16px;border-bottom:1px solid var(--line);vertical-align:middle}
tbody tr:last-child td{border-bottom:none}
tbody tr:hover{background:#F9FBF9}

/* ── FORM ── */
.form-grid{display:grid;gap:16px}.form-grid-2{grid-template-columns:1fr 1fr}
.field{display:flex;flex-direction:column;gap:6px}
.field label{font-size:12.5px;font-weight:600;color:var(--ink-2)}
.field input,.field select,.field textarea{font-family:var(--body);font-size:13.5px;color:var(--ink-2);background:var(--white);border:1.5px solid var(--line);border-radius:9px;padding:9px 12px;outline:none;transition:all .15s}
.field input:focus,.field select:focus,.field textarea:focus{border-color:var(--green);box-shadow:0 0 0 3px rgba(31,122,31,0.1)}

/* ── MODAL ── */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:400;align-items:center;justify-content:center;padding:20px}
.modal-overlay.open{display:flex}
.modal{background:var(--white);border-radius:16px;width:100%;max-width:580px;max-height:92vh;overflow-y:auto;padding:28px;animation:mIn .2s ease}
.modal-lg{max-width:760px}
@keyframes mIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}
.modal-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;padding-bottom:14px;border-bottom:2px solid var(--green-tint)}
.modal-head h2{font-size:18px;font-weight:700;color:var(--ink);display:flex;align-items:center;gap:8px}
.modal-head h2 i{color:var(--green);font-size:16px}
.modal-close{background:none;border:none;cursor:pointer;color:var(--ink-4);font-size:16px;transition:color .15s;width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center}
.modal-close:hover{color:var(--red);background:var(--red-tint)}
.modal-foot{display:flex;justify-content:flex-end;gap:10px;margin-top:22px;padding-top:18px;border-top:1px solid var(--line)}

/* ── FILTERS ── */
.filters{display:flex;gap:10px;align-items:center;flex-wrap:wrap;margin-bottom:16px}
.search-wrap{position:relative;flex:1;min-width:220px}
.search-wrap i{position:absolute;left:11px;top:50%;transform:translateY(-50%);color:var(--ink-4);font-size:13px;pointer-events:none}
.search-wrap input{padding-left:36px;width:100%;height:38px;font-family:var(--body);font-size:13px;background:var(--white);border:1.5px solid var(--line);border-radius:9px;outline:none;color:var(--ink-2);transition:border-color .15s}
.search-wrap input:focus{border-color:var(--green)}
.filter-select{font-family:var(--body);font-size:13px;color:var(--ink-2);background:var(--white);border:1.5px solid var(--line);border-radius:9px;padding:7px 12px;outline:none;cursor:pointer;height:38px;transition:border-color .15s}
.filter-select:focus{border-color:var(--green)}

/* ── AVATAR ── */
.avatar-cell{display:flex;align-items:center;gap:10px}
.tbl-avatar{width:34px;height:34px;border-radius:50%;background:var(--green-tint);border:1.5px solid var(--green-border);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:var(--green);flex-shrink:0}
.tbl-name{font-size:13.5px;font-weight:500;color:var(--ink)}
.tbl-sub{font-size:11px;color:var(--ink-4)}

/* ── BLOOD TYPE TAG ── */
.blood-tag{display:inline-block;font-size:12px;font-weight:700;padding:3px 10px;border-radius:6px;background:var(--red-tint);color:var(--red);border:1px solid var(--red-border)}

/* ── PROGRESS ── */
.progress-bar{height:6px;border-radius:3px;background:var(--line);overflow:hidden;width:110px}
.progress-fill{height:100%;border-radius:3px;background:var(--green)}
.progress-fill.warn{background:var(--yellow-dark)}
.progress-fill.danger{background:var(--red)}

/* ── TWO COL ── */
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:16px}

/* ── ALERT CARDS ── */
.alert-card{background:var(--white);border:1px solid var(--line);border-radius:13px;padding:16px 18px;display:flex;align-items:flex-start;gap:14px;margin-bottom:10px;transition:all .2s}
.alert-card:hover{box-shadow:0 3px 12px rgba(0,0,0,.06)}
.alert-card.critical{border-left:4px solid var(--red)}
.alert-card.warning{border-left:4px solid var(--yellow)}
.alert-card.info{border-left:4px solid var(--green)}
.al-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.al-icon i{font-size:16px}
.al-icon-red{background:var(--red-tint)}.al-icon-red i{color:var(--red)}
.al-icon-yellow{background:var(--yellow-tint)}.al-icon-yellow i{color:var(--yellow-dark)}
.al-icon-green{background:var(--green-tint)}.al-icon-green i{color:var(--green)}
.al-body{flex:1}
.al-title{font-size:14px;font-weight:600;color:var(--ink);margin-bottom:3px}
.al-desc{font-size:12.5px;color:var(--ink-3);line-height:1.5}
.al-meta{font-size:11.5px;color:var(--ink-4);margin-top:5px}
.al-actions{display:flex;gap:7px;align-items:center;flex-shrink:0}

/* ── BLOOD GRID ── */
.blood-grid{display:grid;grid-template-columns:repeat(8,1fr);gap:10px;padding:16px 20px}
.blood-card{background:var(--white);border:1.5px solid var(--line);border-radius:11px;padding:12px 8px;text-align:center;transition:all .2s;cursor:pointer}
.blood-card:hover{border-color:var(--green-border);box-shadow:0 3px 12px rgba(31,122,31,.12);transform:translateY(-2px)}
.blood-card.critical{border-color:var(--red-border);background:var(--red-tint)}
.blood-card.low{border-color:var(--yellow-border);background:var(--yellow-tint)}
.blood-card.normal{border-color:var(--green-border);background:var(--green-tint)}
.b-type{font-size:18px;font-weight:700;color:var(--green-dark);margin-bottom:3px}
.blood-card.critical .b-type{color:var(--red)}
.blood-card.low .b-type{color:var(--yellow-dark)}
.b-units{font-size:13px;font-weight:600;color:var(--ink)}
.b-lbl{font-size:10px;color:var(--ink-4)}
.b-bar{height:4px;border-radius:2px;background:var(--line);margin-top:7px;overflow:hidden}
.b-fill{height:100%;border-radius:2px;background:var(--green)}
.blood-card.critical .b-fill{background:var(--red)}
.blood-card.low .b-fill{background:var(--yellow-dark)}
.b-status{font-size:8.5px;font-weight:700;text-transform:uppercase;letter-spacing:.04em;margin-top:5px;display:block}
.blood-card.normal .b-status{color:var(--green)}
.blood-card.critical .b-status{color:var(--red)}
.blood-card.low .b-status{color:var(--yellow-dark)}

/* ── SECTION DIVIDER ── */
.section-div{display:flex;align-items:center;gap:10px;margin:18px 0 14px}
.section-div span{font-size:11.5px;font-weight:700;color:var(--ink-4);text-transform:uppercase;letter-spacing:.06em;white-space:nowrap}
.section-div::before,.section-div::after{content:'';flex:1;height:1px;background:var(--line)}

/* ── ACTIVITY ── */
.activity-item{display:flex;align-items:flex-start;gap:12px;padding:12px 20px;border-bottom:1px solid var(--line)}
.activity-item:last-child{border-bottom:none}
.act-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0;margin-top:5px}
.act-green{background:var(--green)}.act-yellow{background:var(--yellow)}.act-red{background:var(--red)}.act-blue{background:var(--blue)}
.act-body p{font-size:13.5px;color:var(--ink-2);line-height:1.4}
.act-body small{font-size:11.5px;color:var(--ink-4)}

/* ── PIPELINE ── */
.pipeline{display:flex;align-items:center;gap:0}
.pipe-step{font-size:10.5px;font-weight:600;padding:3px 9px;border:1px solid;border-right:none}
.pipe-step:first-child{border-radius:5px 0 0 5px}
.pipe-step:last-child{border-radius:0 5px 5px 0;border-right:1px solid}
.pipe-done{background:#DCFCE7;color:#15803D;border-color:#86EFAC}
.pipe-active{background:var(--yellow-tint);color:var(--yellow-dark);border-color:var(--yellow-border)}
.pipe-idle{background:#F3F4F6;color:var(--ink-4);border-color:#E5E7EB}
.pipe-rejected{background:var(--red-tint);color:var(--red);border-color:var(--red-border)}

/* ── KPI ROW ── */
.kpi-row{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:18px}
.kpi-card{background:var(--white);border:1px solid var(--line);border-radius:13px;padding:16px 18px;display:flex;align-items:center;gap:12px}
.kpi-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:16px}
.kpi-val{font-size:20px;font-weight:700;color:var(--ink);line-height:1}
.kpi-lbl{font-size:11.5px;color:var(--ink-4);margin-top:2px}

/* ── SCREENING ── */
.screen-status{display:inline-flex;align-items:center;gap:5px;font-size:11.5px;font-weight:600;padding:4px 10px;border-radius:20px}
.screen-pass{background:#DCFCE7;color:#15803D;border:1px solid #86EFAC}
.screen-fail{background:var(--red-tint);color:var(--red);border:1px solid var(--red-border)}
.screen-pending{background:var(--yellow-tint);color:var(--yellow-dark);border:1px solid var(--yellow-border)}

/* ── RELEASE ── */
.release-card{background:var(--white);border:1px solid var(--line);border-radius:13px;padding:16px 18px;display:flex;align-items:center;gap:14px;margin-bottom:10px;transition:all .2s}
.release-card:hover{border-color:var(--green-border);box-shadow:0 3px 10px rgba(31,122,31,.08)}
.release-ico{width:44px;height:44px;border-radius:11px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:18px;background:var(--green-tint);color:var(--green)}

/* ── TOAST ── */
.toast{position:fixed;bottom:28px;right:28px;z-index:9998;background:var(--green-dark);color:#fff;border-radius:12px;padding:14px 20px;display:flex;align-items:center;gap:10px;font-size:13.5px;box-shadow:0 8px 30px rgba(0,0,0,.2);transform:translateY(80px);opacity:0;transition:all .3s ease;pointer-events:none;min-width:260px}
.toast.show{transform:none;opacity:1}
.t-ok{color:var(--green-light)}.t-err{color:#FCA5A5}

/* ── LOGIN / SIGNUP ── */
.auth-shell{display:grid;grid-template-columns:1fr 1fr;min-height:calc(100vh - 36px);width:100%}
.auth-left{background:var(--green-dark);position:relative;overflow:hidden;display:flex;flex-direction:column;justify-content:space-between;padding:44px 52px}
.auth-left::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 80% 65% at 20% 30%,rgba(126,217,87,0.2) 0%,transparent 65%),radial-gradient(ellipse 60% 55% at 80% 80%,rgba(255,215,0,0.1) 0%,transparent 60%);pointer-events:none}
.auth-dot-grid{position:absolute;inset:0;background-image:radial-gradient(circle,rgba(255,255,255,.06) 1px,transparent 1px);background-size:30px 30px;pointer-events:none}
.auth-brand{position:relative;z-index:2;display:flex;align-items:center;gap:12px;text-decoration:none;animation:fadeUp .5s ease forwards;opacity:0}
.auth-brand-icon{width:44px;height:44px;border-radius:12px;background:var(--green-light);display:flex;align-items:center;justify-content:center;color:var(--green-dark);font-size:20px;font-weight:900;flex-shrink:0}
.auth-brand-text b{display:block;font-size:14px;font-weight:700;color:#fff}
.auth-brand-text small{font-size:10.5px;color:rgba(255,255,255,.4)}
.auth-copy{position:relative;z-index:2;animation:fadeUp .55s .15s ease forwards;opacity:0}
.auth-copy h2{font-family:var(--serif);font-size:clamp(34px,3vw,50px);font-style:italic;font-weight:500;color:#fff;line-height:1.15;margin-bottom:14px}
.auth-copy h2 em{font-style:normal;color:var(--green-light)}
.auth-copy p{font-size:15px;color:rgba(255,255,255,.45);line-height:1.75;max-width:360px;font-weight:300}
.auth-stats{position:relative;z-index:2;display:flex;gap:12px;flex-wrap:wrap;animation:fadeUp .55s .28s ease forwards;opacity:0}
.auth-stat{display:flex;align-items:center;gap:9px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:10px;padding:11px 16px}
.auth-stat-ico{width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center}
.auth-stat-ico i{font-size:12px}
.ico-glight{background:rgba(126,217,87,.25)}.ico-glight i{color:var(--green-light)}
.ico-yellow{background:rgba(255,215,0,.2)}.ico-yellow i{color:var(--yellow)}
.ico-white{background:rgba(255,255,255,.1)}.ico-white i{color:rgba(255,255,255,.7)}
.auth-stat-info b{display:block;font-size:13.5px;font-weight:600;color:#F1F5F9}
.auth-stat-info span{font-size:11px;color:rgba(255,255,255,.35)}

.auth-right{display:flex;flex-direction:column;justify-content:center;align-items:center;padding:clamp(32px,4vw,64px);background:var(--white);overflow-y:auto}
.auth-form-wrap{width:100%;max-width:420px;animation:fadeUp .5s .08s ease forwards;opacity:0}
.auth-back{display:inline-flex;align-items:center;gap:7px;font-size:13px;color:var(--ink-3);text-decoration:none;margin-bottom:32px;transition:color .15s;cursor:pointer}
.auth-back:hover{color:var(--green)}
.auth-eyebrow{font-size:11px;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:var(--green);margin-bottom:8px;display:block}
.auth-heading h1{font-family:var(--serif);font-size:clamp(28px,2.5vw,40px);line-height:1.1;color:var(--ink);margin-bottom:8px}
.auth-heading h1 em{font-style:italic;color:var(--green)}
.auth-heading p{font-size:14px;color:var(--ink-3);font-weight:300;line-height:1.6;margin-bottom:26px}

.auth-field{margin-bottom:18px}
.auth-field label{display:block;font-size:12.5px;font-weight:600;color:var(--ink-2);margin-bottom:7px}
.auth-input-wrap{position:relative}
.auth-input-wrap .fi{position:absolute;left:13px;top:50%;transform:translateY(-50%);font-size:13px;color:var(--ink-4);pointer-events:none;transition:color .2s}
.auth-input-wrap input,.auth-input-wrap select{width:100%;height:48px;padding:0 44px 0 42px;font-family:var(--body);font-size:14px;color:var(--ink);background:#F9FAF9;border:1.5px solid var(--line);border-radius:11px;outline:none;transition:all .18s}
.auth-input-wrap input:focus,.auth-input-wrap select:focus{border-color:var(--green);background:var(--white);box-shadow:0 0 0 3px rgba(31,122,31,.1)}
.auth-input-wrap:focus-within .fi{color:var(--green)}
.pw-toggle{position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--ink-4);font-size:13px;padding:4px;transition:color .15s}
.pw-toggle:hover{color:var(--green)}

.auth-meta{display:flex;justify-content:space-between;align-items:center;margin-bottom:22px}
.remember{display:flex;align-items:center;gap:7px;font-size:13px;color:var(--ink-3);cursor:pointer;user-select:none}
.remember input[type="checkbox"]{width:16px;height:16px;accent-color:var(--green);cursor:pointer}
.forgot-link{font-size:13px;color:var(--green);font-weight:500;text-decoration:none;transition:color .15s}
.forgot-link:hover{color:var(--green-dark);text-decoration:underline}

.btn-auth{width:100%;height:50px;display:flex;align-items:center;justify-content:center;gap:9px;font-family:var(--body);font-size:15px;font-weight:600;color:#fff;background:var(--green);border:none;border-radius:11px;cursor:pointer;box-shadow:0 4px 16px rgba(31,122,31,.25);transition:all .18s;letter-spacing:.01em}
.btn-auth:hover{background:var(--green-dark);box-shadow:0 6px 22px rgba(31,122,31,.35);transform:translateY(-1px)}
.btn-auth:active{transform:scale(.99)}

.auth-divider{display:flex;align-items:center;gap:12px;margin:20px 0;font-size:12px;color:var(--ink-4)}
.auth-divider::before,.auth-divider::after{content:'';flex:1;height:1px;background:var(--line)}
.auth-link-row{text-align:center;font-size:13.5px;color:var(--ink-3);margin-top:18px}
.auth-link-row a{color:var(--green);font-weight:600;text-decoration:none;cursor:pointer}.auth-link-row a:hover{text-decoration:underline}
.auth-footer{margin-top:28px;padding-top:20px;border-top:1px solid var(--line);text-align:center;font-size:12px;color:var(--ink-4);line-height:1.6}

/* SIGNUP STEPS */
.reg-steps{display:flex;align-items:center;margin-bottom:24px}
.rs{flex:1;text-align:center;position:relative}
.rs:not(:last-child)::after{content:'';position:absolute;top:13px;left:55%;width:90%;height:2px;background:var(--line);z-index:0}
.rs.done::after{background:var(--green)}
.rs-circle{width:26px;height:26px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;margin:0 auto 5px;position:relative;z-index:1}
.rs.done .rs-circle{background:var(--green);color:#fff}
.rs.active .rs-circle{background:var(--green-light);color:var(--green-dark);box-shadow:0 0 0 3px rgba(126,217,87,.3)}
.rs.idle .rs-circle{background:var(--line);color:var(--ink-4)}
.rs-label{font-size:10.5px;font-weight:500;color:var(--ink-4)}
.rs.done .rs-label{color:var(--green)}
.rs.active .rs-label{color:var(--green-dark);font-weight:600}

.pw-strength-bar{height:4px;background:var(--line);border-radius:2px;overflow:hidden;margin:6px 0 4px}
.pw-bar-fill{height:100%;border-radius:2px;transition:width .3s,background .3s;width:0%}

.form-section{display:none}
.form-section.active{display:block}

.success-screen{text-align:center;padding:20px 0;display:none}
.success-ico{width:72px;height:72px;border-radius:50%;background:var(--green-tint);border:2px solid var(--green-border);display:flex;align-items:center;justify-content:center;margin:0 auto 18px;font-size:30px;color:var(--green)}

.alert-box{display:flex;align-items:flex-start;gap:10px;background:var(--red-tint);border:1px solid var(--red-border);border-radius:10px;padding:12px 14px;margin-bottom:20px;animation:shake .35s ease}
@keyframes shake{0%,100%{transform:translateX(0)}20%{transform:translateX(-5px)}60%{transform:translateX(5px)}}
.alert-box i{color:var(--red);font-size:14px;flex-shrink:0;margin-top:1px}
.alert-box span{font-size:13.5px;color:#C53030;line-height:1.5}

@keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:none}}
</style>
</head>
<body>

<!-- ── DEMO PAGE SWITCHER ── -->
<div class="demo-nav">
  <span>Pages:</span>
  <button class="demo-btn active" onclick="showPage('login')">Login</button>
  <button class="demo-btn" onclick="showPage('signup')">Sign Up</button>
  <button class="demo-btn" onclick="showPage('dashboard')">Dashboard</button>
  <button class="demo-btn" onclick="showPage('donors')">Donors</button>
  <button class="demo-btn" onclick="showPage('inventory')">Inventory</button>
  <button class="demo-btn" onclick="showPage('requests')">Requests</button>
  <button class="demo-btn" onclick="showPage('screening')">Screening</button>
  <button class="demo-btn" onclick="showPage('release')">Release</button>
  <button class="demo-btn" onclick="showPage('reports')">Reports</button>
  <button class="demo-btn" onclick="showPage('alerts')">Alerts</button>
  <button class="demo-btn" onclick="showPage('staff')">Staff</button>
</div>

<!-- ════════════════════════════════════
     LOGIN PAGE
════════════════════════════════════ -->
<div class="page active" id="page-login">
  <div class="auth-shell">
    <div class="auth-left">
      <div class="auth-dot-grid"></div>
      <a class="auth-brand" onclick="showPage('dashboard')">
        <div class="auth-brand-icon"><i class="fas fa-tint"></i></div>
        <div class="auth-brand-text"><b>Blood Bank Management Information System</b><small>Pagamutan ng Dasmariñas</small></div>
      </a>
      <div class="auth-copy">
        <h2>Saving lives<br>through <em>smart</em><br>blood management.</h2>
        <p>Centralized donor records, live inventory tracking, and emergency coordination — all in one secure system.</p>
      </div>
      <div class="auth-stats">
        <div class="auth-stat"><div class="auth-stat-ico ico-glight"><i class="fas fa-users"></i></div><div class="auth-stat-info"><b>5,240+</b><span>Donor records</span></div></div>
        <div class="auth-stat"><div class="auth-stat-ico ico-yellow"><i class="fas fa-boxes"></i></div><div class="auth-stat-info"><b>1,250</b><span>Units in stock</span></div></div>
        <div class="auth-stat"><div class="auth-stat-ico ico-white"><i class="fas fa-clock"></i></div><div class="auth-stat-info"><b>24 / 7</b><span>Monitoring</span></div></div>
      </div>
    </div>
    <div class="auth-right">
      <div class="auth-form-wrap">
        <span class="auth-eyebrow">Staff &amp; Admin Access</span>
        <div class="auth-heading">
          <h1>Welcome<br><em>back.</em></h1>
          <p>Sign in to your BBMIS account. You'll be redirected based on your role.</p>
        </div>
        <div class="auth-field">
          <label>Email address</label>
          <div class="auth-input-wrap"><i class="fas fa-envelope fi"></i><input type="email" placeholder="you@pagamutandasma.gov.ph" value="admin@bbmis.gov.ph"></div>
        </div>
        <div class="auth-field">
          <label>Password</label>
          <div class="auth-input-wrap"><i class="fas fa-lock fi"></i><input type="password" id="loginPw" placeholder="Enter your password" value="password"><button type="button" class="pw-toggle" onclick="togglePw('loginPw','loginPwIco')"><i id="loginPwIco" class="fas fa-eye"></i></button></div>
        </div>
        <div class="auth-meta">
          <label class="remember"><input type="checkbox" checked> Remember me</label>
          <a class="forgot-link">Forgot password?</a>
        </div>
        <button class="btn-auth" onclick="showPage('dashboard')"><i class="fas fa-sign-in-alt" style="font-size:14px"></i> Sign in to dashboard</button>
        <div class="auth-divider">or</div>
        <div class="auth-link-row">New staff member? <a onclick="showPage('signup')">Create an account</a></div>
        <div class="auth-footer">Blood Bank Management Information System<br>Pagamutan ng Lungsod ng Dasmariñas · Authorized personnel only</div>
      </div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════
     SIGN UP PAGE
════════════════════════════════════ -->
<div class="page" id="page-signup">
  <div class="auth-shell">
    <div class="auth-left">
      <div class="auth-dot-grid"></div>
      <a class="auth-brand" onclick="showPage('login')">
        <div class="auth-brand-icon"><i class="fas fa-tint"></i></div>
        <div class="auth-brand-text"><b>Blood Bank Management Information System</b><small>Pagamutan ng Dasmariñas</small></div>
      </a>
      <div class="auth-copy">
        <h2>Join the<br><em>BBMIS</em> team.</h2>
        <p>Create your staff account to access the Blood Bank Management Information System. Admin approval is required before you can log in.</p>
      </div>
      <div class="auth-stats">
        <div class="auth-stat"><div class="auth-stat-ico ico-glight"><i class="fas fa-user-plus"></i></div><div class="auth-stat-info"><b>Step 1</b><span>Personal info</span></div></div>
        <div class="auth-stat"><div class="auth-stat-ico ico-yellow"><i class="fas fa-lock"></i></div><div class="auth-stat-info"><b>Step 2</b><span>Set credentials</span></div></div>
        <div class="auth-stat"><div class="auth-stat-ico ico-white"><i class="fas fa-check-circle"></i></div><div class="auth-stat-info"><b>Step 3</b><span>Admin approval</span></div></div>
      </div>
    </div>
    <div class="auth-right">
      <div class="auth-form-wrap">
        <a class="auth-back" onclick="showPage('login')"><i class="fas fa-arrow-left"></i> Back to login</a>
        <span class="auth-eyebrow">Staff Registration</span>
        <div class="auth-heading">
          <h1>Create your<br><em>account.</em></h1>
          <p>Fill in the form to register as a staff member.</p>
        </div>
        <!-- Steps -->
        <div class="reg-steps" id="regSteps">
          <div class="rs active" id="rs1"><div class="rs-circle">1</div><div class="rs-label">Personal info</div></div>
          <div class="rs idle"   id="rs2"><div class="rs-circle">2</div><div class="rs-label">Credentials</div></div>
          <div class="rs idle"   id="rs3"><div class="rs-circle">3</div><div class="rs-label">Review</div></div>
        </div>
        <!-- Success screen -->
        <div class="success-screen" id="regSuccess">
          <div class="success-ico"><i class="fas fa-check"></i></div>
          <h3 style="font-family:var(--serif);font-size:24px;font-style:italic;color:var(--ink);margin-bottom:8px">Registration submitted!</h3>
          <p style="font-size:13.5px;color:var(--ink-3);line-height:1.6;margin-bottom:20px">Your account is pending admin approval. You'll be notified once activated.</p>
          <button class="btn-auth" style="width:auto;padding:10px 28px" onclick="showPage('login')"><i class="fas fa-sign-in-alt"></i> Back to login</button>
        </div>
        <!-- Section 1 -->
        <div class="form-section active" id="sec1">
          <div class="form-grid form-grid-2" style="gap:14px">
            <div class="auth-field"><label>First name</label><div class="auth-input-wrap"><i class="fas fa-user fi"></i><input type="text" placeholder="e.g. Maria" id="regFirst"></div></div>
            <div class="auth-field"><label>Last name</label><div class="auth-input-wrap"><i class="fas fa-user fi"></i><input type="text" placeholder="e.g. Santos" id="regLast"></div></div>
            <div class="auth-field"><label>Email address</label><div class="auth-input-wrap"><i class="fas fa-envelope fi"></i><input type="email" placeholder="you@pagamutandasma.gov.ph" id="regEmail"></div></div>
            <div class="auth-field"><label>Contact number</label><div class="auth-input-wrap"><i class="fas fa-phone fi"></i><input type="tel" placeholder="09XX XXX XXXX"></div></div>
            <div class="auth-field"><label>Date of birth</label><div class="auth-input-wrap"><i class="fas fa-calendar fi"></i><input type="date"></div></div>
            <div class="auth-field"><label>Department</label><div class="auth-input-wrap"><i class="fas fa-briefcase fi"></i><select style="appearance:none"><option value="">Select department</option><option>Blood Bank Staff</option><option>Laboratory Technician</option><option>Nurse</option><option>Medical Technologist</option><option>Administrative Staff</option></select></div></div>
          </div>
          <button class="btn-auth" style="margin-top:8px" onclick="regStep(2)">Next <i class="fas fa-arrow-right"></i></button>
        </div>
        <!-- Section 2 -->
        <div class="form-section" id="sec2">
          <div class="auth-field"><label>Username</label><div class="auth-input-wrap"><i class="fas fa-at fi"></i><input type="text" placeholder="e.g. msantos"></div></div>
          <div class="auth-field"><label>Password</label><div class="auth-input-wrap"><i class="fas fa-lock fi"></i><input type="password" id="regPw" placeholder="Create a strong password" oninput="checkPwStr(this.value)"><button type="button" class="pw-toggle" onclick="togglePw('regPw','regPwIco')"><i id="regPwIco" class="fas fa-eye"></i></button></div><div class="pw-strength-bar"><div class="pw-bar-fill" id="pwBar"></div></div><span id="pwLabel" style="font-size:11px;color:var(--ink-4)">Enter a password</span></div>
          <div class="auth-field"><label>Confirm password</label><div class="auth-input-wrap"><i class="fas fa-lock fi"></i><input type="password" id="regPwC" placeholder="Re-enter password"><button type="button" class="pw-toggle" onclick="togglePw('regPwC','regPwCIco')"><i id="regPwCIco" class="fas fa-eye"></i></button></div><span id="matchHint" style="font-size:11px;color:var(--ink-4)">Must match password above</span></div>
          <div style="display:flex;gap:10px;margin-top:8px">
            <button class="btn-auth" style="background:var(--line);color:var(--ink-2);box-shadow:none;flex:1" onclick="regStep(1)"><i class="fas fa-arrow-left"></i> Back</button>
            <button class="btn-auth" style="flex:2" onclick="regStep(3)">Next <i class="fas fa-arrow-right"></i></button>
          </div>
        </div>
        <!-- Section 3 -->
        <div class="form-section" id="sec3">
          <div style="background:var(--green-tint);border:1px solid var(--green-border);border-radius:12px;padding:16px 18px;margin-bottom:16px;font-size:13.5px;color:var(--ink-2);line-height:2" id="reviewContent"></div>
          <div style="background:var(--yellow-tint);border:1px solid var(--yellow-border);border-radius:10px;padding:12px 16px;font-size:13px;color:#92400E;display:flex;gap:9px;align-items:flex-start;margin-bottom:16px"><i class="fas fa-info-circle" style="color:var(--yellow-dark);margin-top:2px;flex-shrink:0"></i><div>Your account will be created with <b>Staff</b> role and requires admin approval before login.</div></div>
          <label style="display:flex;align-items:flex-start;gap:9px;cursor:pointer;font-size:13px;color:var(--ink-2);margin-bottom:16px"><input type="checkbox" required style="margin-top:2px;accent-color:var(--green)"> I confirm all information is accurate and agree to BBMIS terms of use.</label>
          <div style="display:flex;gap:10px">
            <button class="btn-auth" style="background:var(--line);color:var(--ink-2);box-shadow:none;flex:1" onclick="regStep(2)"><i class="fas fa-arrow-left"></i> Back</button>
            <button class="btn-auth" style="flex:2" onclick="submitReg()"><i class="fas fa-check-circle"></i> Submit registration</button>
          </div>
        </div>
        <div class="auth-link-row">Already have an account? <a onclick="showPage('login')">Sign in</a></div>
      </div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════
     DASHBOARD
════════════════════════════════════ -->
<div class="page" id="page-dashboard">
  <nav class="sidebar">
    <a class="sb-brand" onclick="showPage('dashboard')"><div class="sb-brand-icon"><i class="fas fa-tint"></i></div><div class="sb-brand-text"><b>BBMIS</b><small>Pagamutan ng Dasmariñas</small></div></a>
    <div class="sb-section"><span class="sb-section-label">Main</span>
      <a class="sb-link active" onclick="showPage('dashboard')"><i class="fas fa-chart-pie"></i> Dashboard</a>
      <a class="sb-link" onclick="showPage('donors')"><i class="fas fa-users"></i> Donor Management</a>
      <a class="sb-link" onclick="showPage('inventory')"><i class="fas fa-tint"></i> Blood Inventory</a>
      <a class="sb-link" onclick="showPage('requests')"><i class="fas fa-file-medical"></i> Blood Requests <span class="sb-badge">4</span></a>
      <a class="sb-link" onclick="showPage('screening')"><i class="fas fa-vial"></i> Screening Records</a>
      <a class="sb-link" onclick="showPage('release')"><i class="fas fa-box-open"></i> Blood Release</a>
    </div>
    <div class="sb-section"><span class="sb-section-label">Reports</span>
      <a class="sb-link" onclick="showPage('reports')"><i class="fas fa-chart-bar"></i> Reports &amp; Analytics</a>
      <a class="sb-link" onclick="showPage('alerts')"><i class="fas fa-bell"></i> Alerts <span class="sb-badge">5</span></a>
    </div>
    <div class="sb-section"><span class="sb-section-label">Admin only</span>
      <a class="sb-link" onclick="showPage('staff')"><i class="fas fa-user-cog"></i> Staff Management</a>
    </div>
    <div class="sb-bottom"><div class="sb-user"><div class="sb-avatar">JD</div><div class="sb-user-info"><b>Juan Dela Cruz</b><small>Admin</small></div><span class="sb-logout" onclick="showPage('login')"><i class="fas fa-sign-out-alt"></i></span></div></div>
  </nav>
  <div class="main">
    <div class="topbar">
      <div class="topbar-left"><div class="topbar-title">Dashboard</div><div class="topbar-breadcrumb">Home / Dashboard</div></div>
      <div class="topbar-right">
        <div class="topbar-btn"><i class="fas fa-bell"></i><span class="notif-dot"></span></div>
        <div class="topbar-btn"><i class="fas fa-user-circle"></i></div>
      </div>
    </div>
    <div class="content">
      <div class="page-header">
        <div><h2>Dashboard</h2><p>Welcome back, Juan! Here's your system overview for today.</p></div>
        <div style="display:flex;gap:10px">
          <select class="filter-select"><option>This month</option><option>Last month</option><option>This year</option></select>
          <button class="btn btn-primary"><i class="fas fa-download"></i> Export Report</button>
        </div>
      </div>
      <!-- Stat cards -->
      <div class="stat-grid">
        <div class="stat-card border-green"><div class="stat-icon si-green"><i class="fas fa-users"></i></div><div><div class="stat-val">5,240</div><div class="stat-lbl">Total donors</div><div class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> 38 added this month</div></div></div>
        <div class="stat-card border-blue"><div class="stat-icon si-blue"><i class="fas fa-boxes"></i></div><div><div class="stat-val">1,250</div><div class="stat-lbl">Units in stock</div><div class="stat-trend trend-down"><i class="fas fa-arrow-down"></i> 18 expiring soon</div></div></div>
        <div class="stat-card border-yellow"><div class="stat-icon si-yellow"><i class="fas fa-file-medical"></i></div><div><div class="stat-val">4</div><div class="stat-lbl">Pending requests</div><div class="stat-trend trend-warn"><i class="fas fa-exclamation-circle"></i> 1 urgent</div></div></div>
        <div class="stat-card border-green"><div class="stat-icon si-orange"><i class="fas fa-user-cog"></i></div><div><div class="stat-val">12</div><div class="stat-lbl">Active staff</div><div class="stat-trend trend-up"><i class="fas fa-user-check"></i> 11 active</div></div></div>
      </div>
      <!-- KPI row -->
      <div class="kpi-row">
        <div class="kpi-card"><div class="kpi-icon si-green"><i class="fas fa-check-circle"></i></div><div><div class="kpi-val">94%</div><div class="kpi-lbl">Request fulfillment rate</div></div></div>
        <div class="kpi-card"><div class="kpi-icon si-yellow"><i class="fas fa-clock"></i></div><div><div class="kpi-val">2.4 hrs</div><div class="kpi-lbl">Avg. request processing</div></div></div>
        <div class="kpi-card"><div class="kpi-icon si-blue"><i class="fas fa-user-friends"></i></div><div><div class="kpi-val">4,890</div><div class="kpi-lbl">Eligible donors</div></div></div>
      </div>
      <!-- Blood grid -->
      <div class="card" style="margin-bottom:16px">
        <div class="card-head"><div><h3><i class="fas fa-tint"></i> Blood units by type</h3><p>Current stock — 2 critical · 2 low · 4 normal</p></div><button class="btn btn-outline btn-sm" onclick="showPage('inventory')">View inventory</button></div>
        <div class="blood-grid">
          <div class="blood-card normal"><div class="b-type">A+</div><div class="b-units">210</div><div class="b-lbl">units</div><div class="b-bar"><div class="b-fill" style="width:84%"></div></div><span class="b-status">Normal</span></div>
          <div class="blood-card low"><div class="b-type">A−</div><div class="b-units">45</div><div class="b-lbl">units</div><div class="b-bar"><div class="b-fill" style="width:18%"></div></div><span class="b-status">Low</span></div>
          <div class="blood-card normal"><div class="b-type">B+</div><div class="b-units">180</div><div class="b-lbl">units</div><div class="b-bar"><div class="b-fill" style="width:72%"></div></div><span class="b-status">Normal</span></div>
          <div class="blood-card critical"><div class="b-type">B−</div><div class="b-units">30</div><div class="b-lbl">units</div><div class="b-bar"><div class="b-fill" style="width:12%"></div></div><span class="b-status">⚠ Critical</span></div>
          <div class="blood-card low"><div class="b-type">AB+</div><div class="b-units">95</div><div class="b-lbl">units</div><div class="b-bar"><div class="b-fill" style="width:38%"></div></div><span class="b-status">Low</span></div>
          <div class="blood-card critical"><div class="b-type">AB−</div><div class="b-units">20</div><div class="b-lbl">units</div><div class="b-bar"><div class="b-fill" style="width:8%"></div></div><span class="b-status">⚠ Critical</span></div>
          <div class="blood-card normal"><div class="b-type">O+</div><div class="b-units">520</div><div class="b-lbl">units</div><div class="b-bar"><div class="b-fill" style="width:100%"></div></div><span class="b-status">Normal</span></div>
          <div class="blood-card normal"><div class="b-type">O−</div><div class="b-units">150</div><div class="b-lbl">units</div><div class="b-bar"><div class="b-fill" style="width:60%"></div></div><span class="b-status">Normal</span></div>
        </div>
      </div>
      <!-- Charts row -->
      <div class="two-col" style="margin-bottom:16px">
        <div class="card"><div class="card-head"><div><h3><i class="fas fa-chart-line"></i> Donation trend</h3><p>Monthly units — 2025</p></div></div><div style="padding:16px 18px"><canvas id="trendChart" style="max-height:200px"></canvas></div></div>
        <div class="card"><div class="card-head"><div><h3><i class="fas fa-bullseye"></i> Monthly goal</h3><p>March 2025 — target: 700 units</p></div><span class="badge badge-green" style="font-size:12px">88%</span></div>
          <div style="padding:16px 18px">
            <div style="font-size:26px;font-weight:700;color:var(--green-dark)">617 <span style="font-size:14px;color:var(--ink-4);font-weight:400">/ 700 units</span></div>
            <div style="font-size:12px;color:var(--ink-4);margin:4px 0 12px">83 more units needed to hit this month's target</div>
            <div style="height:10px;background:var(--line);border-radius:5px;overflow:hidden;margin-bottom:7px"><div id="goalBar" style="height:100%;border-radius:5px;background:var(--green);width:0%;transition:width 1s ease"></div></div>
            <div style="display:flex;justify-content:space-between;font-size:10.5px;color:var(--ink-4);margin-bottom:14px"><span>0</span><span>350</span><span>700</span></div>
            <div style="display:flex;gap:8px;flex-wrap:wrap">
              <span class="badge badge-green"><i class="fas fa-check" style="font-size:8px"></i> 25%</span>
              <span class="badge badge-green"><i class="fas fa-check" style="font-size:8px"></i> 50%</span>
              <span class="badge badge-green"><i class="fas fa-check" style="font-size:8px"></i> 75%</span>
              <span class="badge badge-gray"><i class="fas fa-circle" style="font-size:7px"></i> 100% goal</span>
            </div>
            <div style="margin-top:12px;font-size:12px;color:var(--ink-3)"><b style="color:var(--ink)">9 days</b> left · Current pace: <b style="color:var(--green)">~20 units/day</b> ✓</div>
          </div>
        </div>
      </div>
      <!-- Two col: activity + alerts -->
      <div class="two-col">
        <div class="card">
          <div class="card-head"><div><h3><i class="fas fa-history"></i> Recent activity</h3><p>Latest actions</p></div></div>
          <div class="activity-item"><span class="act-dot act-green"></span><div class="act-body"><p>New donor <b>Maria Santos</b> added (O+)</p><small>2 min ago · Staff: Cruz</small></div></div>
          <div class="activity-item"><span class="act-dot act-blue"></span><div class="act-body"><p>Request <b>#REQ-0042</b> approved</p><small>15 min ago · Admin: Dela Cruz</small></div></div>
          <div class="activity-item"><span class="act-dot act-yellow"></span><div class="act-body"><p>Low stock alert triggered for <b>B−</b></p><small>1 hour ago · System</small></div></div>
          <div class="activity-item"><span class="act-dot act-red"></span><div class="act-body"><p>12 units of <b>A+</b> expiring in 3 days</p><small>2 hours ago · System</small></div></div>
          <div class="activity-item"><span class="act-dot act-green"></span><div class="act-body"><p>50 units of <b>O+</b> added to inventory</p><small>3 hours ago · Staff: Reyes</small></div></div>
        </div>
        <div class="card">
          <div class="card-head"><div><h3><i class="fas fa-bell"></i> Active alerts</h3><p>Requires attention</p></div><button class="btn btn-outline btn-sm" onclick="showPage('alerts')">View all</button></div>
          <div class="activity-item"><div style="width:28px;height:28px;border-radius:7px;background:var(--red-tint);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-exclamation-triangle" style="color:var(--red);font-size:11px"></i></div><div class="act-body"><p>B− critically low (30 units)</p><small>Min threshold: 50 units</small></div><span class="badge badge-red">Critical</span></div>
          <div class="activity-item"><div style="width:28px;height:28px;border-radius:7px;background:var(--red-tint);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-exclamation-triangle" style="color:var(--red);font-size:11px"></i></div><div class="act-body"><p>AB− stock low (20 units)</p><small>Min threshold: 40 units</small></div><span class="badge badge-red">Critical</span></div>
          <div class="activity-item"><div style="width:28px;height:28px;border-radius:7px;background:var(--yellow-tint);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-clock" style="color:var(--yellow-dark);font-size:11px"></i></div><div class="act-body"><p>12 units A+ expiring in 4 days</p><small>Batch BTH-0041 — Mar 27</small></div><span class="badge badge-yellow">Expiring</span></div>
          <div class="activity-item"><div style="width:28px;height:28px;border-radius:7px;background:var(--yellow-tint);display:flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fas fa-file-medical" style="color:var(--yellow-dark);font-size:11px"></i></div><div class="act-body"><p>4 blood requests pending</p><small>1 urgent from Emergency Ward</small></div><span class="badge badge-yellow">Pending</span></div>
        </div>
      </div>
      <!-- Pending requests table -->
      <div class="card" style="margin-top:16px">
        <div class="card-head"><div><h3><i class="fas fa-list-alt"></i> Pending blood requests</h3><p>Requires approval</p></div><button class="btn btn-primary btn-sm" onclick="showPage('requests')"><i class="fas fa-arrow-right"></i> View all</button></div>
        <table><thead><tr><th>Request ID</th><th>Ward</th><th>Blood type</th><th>Units</th><th>Priority</th><th>Submitted</th><th>Action</th></tr></thead>
        <tbody>
          <tr><td><b>#REQ-0046</b></td><td>Emergency Ward</td><td><span class="blood-tag">O−</span></td><td>5 units</td><td><span class="badge badge-red">Urgent</span></td><td>Today, 9:41 AM</td><td><button class="btn btn-primary btn-sm" onclick="showPage('requests')">Review</button></td></tr>
          <tr><td><b>#REQ-0045</b></td><td>Surgery Dept.</td><td><span class="blood-tag" style="color:var(--blue);background:var(--blue-tint);border-color:var(--blue-border)">A+</span></td><td>3 units</td><td><span class="badge badge-yellow">High</span></td><td>Today, 8:20 AM</td><td><button class="btn btn-primary btn-sm" onclick="showPage('requests')">Review</button></td></tr>
          <tr><td><b>#REQ-0044</b></td><td>ICU</td><td><span class="blood-tag" style="color:var(--green);background:var(--green-tint);border-color:var(--green-border)">B+</span></td><td>2 units</td><td><span class="badge badge-gray">Normal</span></td><td>Yesterday</td><td><button class="btn btn-primary btn-sm" onclick="showPage('requests')">Review</button></td></tr>
        </tbody></table>
      </div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════
     DONORS
════════════════════════════════════ -->
<div class="page" id="page-donors">
  <nav class="sidebar">
    <a class="sb-brand" onclick="showPage('dashboard')"><div class="sb-brand-icon"><i class="fas fa-tint"></i></div><div class="sb-brand-text"><b>BBMIS</b><small>Pagamutan ng Dasmariñas</small></div></a>
    <div class="sb-section"><span class="sb-section-label">Main</span>
      <a class="sb-link" onclick="showPage('dashboard')"><i class="fas fa-chart-pie"></i> Dashboard</a>
      <a class="sb-link active"><i class="fas fa-users"></i> Donor Management</a>
      <a class="sb-link" onclick="showPage('inventory')"><i class="fas fa-tint"></i> Blood Inventory</a>
      <a class="sb-link" onclick="showPage('requests')"><i class="fas fa-file-medical"></i> Blood Requests <span class="sb-badge">4</span></a>
      <a class="sb-link" onclick="showPage('screening')"><i class="fas fa-vial"></i> Screening Records</a>
      <a class="sb-link" onclick="showPage('release')"><i class="fas fa-box-open"></i> Blood Release</a>
    </div>
    <div class="sb-section"><span class="sb-section-label">Reports</span>
      <a class="sb-link" onclick="showPage('reports')"><i class="fas fa-chart-bar"></i> Reports &amp; Analytics</a>
      <a class="sb-link" onclick="showPage('alerts')"><i class="fas fa-bell"></i> Alerts <span class="sb-badge">5</span></a>
    </div>
    <div class="sb-section"><span class="sb-section-label">Admin only</span>
      <a class="sb-link" onclick="showPage('staff')"><i class="fas fa-user-cog"></i> Staff Management</a>
    </div>
    <div class="sb-bottom"><div class="sb-user"><div class="sb-avatar">JD</div><div class="sb-user-info"><b>Juan Dela Cruz</b><small>Admin</small></div><span class="sb-logout" onclick="showPage('login')"><i class="fas fa-sign-out-alt"></i></span></div></div>
  </nav>
  <div class="main">
    <div class="topbar"><div class="topbar-left"><div class="topbar-title">Donor Management</div><div class="topbar-breadcrumb">Home / Donors</div></div><div class="topbar-right"><div class="topbar-btn"><i class="fas fa-bell"></i><span class="notif-dot"></span></div><div class="topbar-btn"><i class="fas fa-user-circle"></i></div></div></div>
    <div class="content">
      <div class="page-header"><div><h2>Donors</h2><p>Manage all donor records — eligibility auto-calculated (56-day rule)</p></div><button class="btn btn-primary" onclick="openModal('addDonorModal')"><i class="fas fa-plus"></i> Add donor</button></div>
      <div class="stat-grid">
        <div class="stat-card border-green"><div class="stat-icon si-green"><i class="fas fa-users"></i></div><div><div class="stat-val">5,240</div><div class="stat-lbl">Total donors</div></div></div>
        <div class="stat-card border-green"><div class="stat-icon si-green"><i class="fas fa-check-circle"></i></div><div><div class="stat-val">4,520</div><div class="stat-lbl">Eligible now</div></div></div>
        <div class="stat-card" style="border-left:4px solid #7C3AED"><div class="stat-icon" style="background:#F5F3FF;color:#7C3AED"><i class="fas fa-clock"></i></div><div><div class="stat-val">370</div><div class="stat-lbl">Eligible soon (≤7 days)</div></div></div>
        <div class="stat-card border-yellow"><div class="stat-icon si-yellow"><i class="fas fa-ban"></i></div><div><div class="stat-val">312</div><div class="stat-lbl">On deferral</div></div></div>
      </div>
      <div class="filters">
        <div class="search-wrap"><i class="fas fa-search"></i><input placeholder="Search by name, ID or blood type…"></div>
        <select class="filter-select"><option>All blood types</option><option>A+</option><option>A−</option><option>B+</option><option>B−</option><option>AB+</option><option>AB−</option><option>O+</option><option>O−</option></select>
        <select class="filter-select"><option>All statuses</option><option>Eligible</option><option>Eligible Soon</option><option>Deferred</option><option>Inactive</option></select>
        <button class="btn btn-outline"><i class="fas fa-file-import"></i> Import</button>
        <button class="btn btn-outline"><i class="fas fa-download"></i> Export</button>
      </div>
      <div class="card"><table>
        <thead><tr><th>Donor</th><th>Donor ID</th><th>Blood type</th><th>Last donation</th><th>Next eligible</th><th>Donations</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
          <tr><td><div class="avatar-cell"><div class="tbl-avatar">MS</div><div><div class="tbl-name">Maria Santos</div><div class="tbl-sub">maria.santos@email.com</div></div></div></td><td>DNR-0001</td><td><span class="blood-tag">O+</span></td><td>Mar 15, 2025</td><td><span style="color:#7C3AED;font-size:12px;font-weight:600"><i class="fas fa-clock"></i> Apr 10, 2025</span></td><td>12</td><td><span class="badge" style="background:#F5F3FF;color:#7C3AED;border:1px solid #C4B5FD">Eligible Soon</span></td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-print"></i></button><button class="btn btn-outline btn-sm" style="color:var(--blue);border-color:var(--blue-border)"><i class="fas fa-bell"></i></button><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></div></td></tr>
          <tr><td><div class="avatar-cell"><div class="tbl-avatar">JR</div><div><div class="tbl-name">Jose Reyes</div><div class="tbl-sub">jose.reyes@email.com</div></div></div></td><td>DNR-0002</td><td><span class="blood-tag" style="color:var(--blue);background:var(--blue-tint);border-color:var(--blue-border)">A+</span></td><td>Feb 28, 2025</td><td><span style="color:var(--ink-3);font-size:12px">Apr 25, 2025</span></td><td>7</td><td><span class="badge badge-gray">Not Yet Eligible</span></td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-print"></i></button><button class="btn btn-outline btn-sm" disabled style="opacity:.4"><i class="fas fa-bell"></i></button><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></div></td></tr>
          <tr><td><div class="avatar-cell"><div class="tbl-avatar">AC</div><div><div class="tbl-name">Ana Cruz</div><div class="tbl-sub">ana.cruz@email.com</div></div></div></td><td>DNR-0003</td><td><span class="blood-tag" style="color:var(--green);background:var(--green-tint);border-color:var(--green-border)">B+</span></td><td>Jan 10, 2025</td><td><span style="color:var(--yellow-dark);font-size:12px;font-weight:600"><i class="fas fa-ban"></i> Apr 10, 2025</span></td><td>3</td><td><span class="badge badge-yellow">Deferred</span></td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-print"></i></button><button class="btn btn-outline btn-sm" disabled style="opacity:.4"><i class="fas fa-bell"></i></button><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></div></td></tr>
          <tr><td><div class="avatar-cell"><div class="tbl-avatar">PL</div><div><div class="tbl-name">Pedro Lopez</div><div class="tbl-sub">pedro.lopez@email.com</div></div></div></td><td>DNR-0004</td><td><span class="blood-tag" style="color:var(--ink-3);background:#F3F4F6;border-color:#E5E7EB">AB−</span></td><td>Jan 25, 2025</td><td><span style="color:var(--green);font-size:12px;font-weight:600"><i class="fas fa-check-circle"></i> Now</span></td><td>20</td><td><span class="badge badge-green">Eligible</span></td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-print"></i></button><button class="btn btn-outline btn-sm" style="color:var(--blue);border-color:var(--blue-border)"><i class="fas fa-bell"></i></button><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></div></td></tr>
        </tbody>
      </table></div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════
     INVENTORY
════════════════════════════════════ -->
<div class="page" id="page-inventory">
  <nav class="sidebar">
    <a class="sb-brand" onclick="showPage('dashboard')"><div class="sb-brand-icon"><i class="fas fa-tint"></i></div><div class="sb-brand-text"><b>BBMIS</b><small>Pagamutan ng Dasmariñas</small></div></a>
    <div class="sb-section"><span class="sb-section-label">Main</span>
      <a class="sb-link" onclick="showPage('dashboard')"><i class="fas fa-chart-pie"></i> Dashboard</a>
      <a class="sb-link" onclick="showPage('donors')"><i class="fas fa-users"></i> Donor Management</a>
      <a class="sb-link active"><i class="fas fa-tint"></i> Blood Inventory</a>
      <a class="sb-link" onclick="showPage('requests')"><i class="fas fa-file-medical"></i> Blood Requests <span class="sb-badge">4</span></a>
      <a class="sb-link" onclick="showPage('screening')"><i class="fas fa-vial"></i> Screening Records</a>
      <a class="sb-link" onclick="showPage('release')"><i class="fas fa-box-open"></i> Blood Release</a>
    </div>
    <div class="sb-section"><span class="sb-section-label">Reports</span>
      <a class="sb-link" onclick="showPage('reports')"><i class="fas fa-chart-bar"></i> Reports &amp; Analytics</a>
      <a class="sb-link" onclick="showPage('alerts')"><i class="fas fa-bell"></i> Alerts <span class="sb-badge">5</span></a>
    </div>
    <div class="sb-section"><span class="sb-section-label">Admin only</span><a class="sb-link" onclick="showPage('staff')"><i class="fas fa-user-cog"></i> Staff Management</a></div>
    <div class="sb-bottom"><div class="sb-user"><div class="sb-avatar">JD</div><div class="sb-user-info"><b>Juan Dela Cruz</b><small>Admin</small></div><span class="sb-logout" onclick="showPage('login')"><i class="fas fa-sign-out-alt"></i></span></div></div>
  </nav>
  <div class="main">
    <div class="topbar"><div class="topbar-left"><div class="topbar-title">Blood Inventory</div><div class="topbar-breadcrumb">Home / Inventory</div></div><div class="topbar-right"><div class="topbar-btn"><i class="fas fa-bell"></i><span class="notif-dot"></span></div><div class="topbar-btn"><i class="fas fa-user-circle"></i></div></div></div>
    <div class="content">
      <div class="page-header"><div><h2>Blood inventory</h2><p>Track blood units by type, expiry status, and movement</p></div><div style="display:flex;gap:10px"><button class="btn btn-outline"><i class="fas fa-download"></i> Export</button><button class="btn btn-primary" onclick="openModal('addInvModal')"><i class="fas fa-plus"></i> Add units</button></div></div>
      <div class="stat-grid">
        <div class="stat-card border-blue"><div class="stat-icon si-blue"><i class="fas fa-boxes"></i></div><div><div class="stat-val">1,250</div><div class="stat-lbl">Total units</div></div></div>
        <div class="stat-card border-red"><div class="stat-icon si-red"><i class="fas fa-exclamation-triangle"></i></div><div><div class="stat-val">2</div><div class="stat-lbl">Critical types</div></div></div>
        <div class="stat-card border-yellow"><div class="stat-icon si-yellow"><i class="fas fa-clock"></i></div><div><div class="stat-val">18</div><div class="stat-lbl">Expiring in 7 days</div></div></div>
        <div class="stat-card border-green"><div class="stat-icon si-green"><i class="fas fa-plus-circle"></i></div><div><div class="stat-val">120</div><div class="stat-lbl">Added this month</div></div></div>
      </div>
      <!-- Expiry legend -->
      <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:16px">
        <span style="font-size:12px;font-weight:600;color:var(--ink-4)">Expiry key:</span>
        <span class="badge badge-green"><i class="fas fa-circle" style="font-size:7px"></i> Safe (14+ days)</span>
        <span class="badge badge-yellow"><i class="fas fa-circle" style="font-size:7px"></i> Warning (7–14 days)</span>
        <span class="badge badge-red"><i class="fas fa-circle" style="font-size:7px"></i> Critical (&lt;7 days)</span>
        <span class="badge badge-gray"><i class="fas fa-circle" style="font-size:7px"></i> Expired</span>
      </div>
      <!-- Tabs -->
      <div style="display:flex;gap:0;margin-bottom:16px;border-bottom:2px solid var(--line)">
        <div style="font-size:13.5px;font-weight:600;color:var(--green);padding:10px 18px;border-bottom:2px solid var(--green);margin-bottom:-2px;cursor:pointer">Stock overview</div>
        <div style="font-size:13.5px;font-weight:500;color:var(--ink-3);padding:10px 18px;cursor:pointer">Unit details</div>
        <div style="font-size:13.5px;font-weight:500;color:var(--ink-3);padding:10px 18px;cursor:pointer">Movement log</div>
      </div>
      <div class="card"><table>
        <thead><tr><th>Blood type</th><th>Units available</th><th>Stock level</th><th>Min. threshold</th><th>Expiry status</th><th>Expiring soon</th><th>Last updated</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
          <tr><td><span class="blood-tag" style="color:var(--green);background:var(--green-tint);border-color:var(--green-border)">A+</span></td><td><b>210</b></td><td><div class="progress-bar"><div class="progress-fill" style="width:84%"></div></div></td><td>50 units</td><td><span class="badge badge-yellow">Warning</span></td><td style="color:var(--yellow-dark);font-size:12px;font-weight:600">12 units — Mar 27</td><td>Today</td><td><span class="badge badge-green">Normal</span></td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></div></td></tr>
          <tr style="background:var(--yellow-tint)"><td><span class="blood-tag">A−</span></td><td><b>45</b></td><td><div class="progress-bar"><div class="progress-fill warn" style="width:18%"></div></div></td><td>80 units</td><td><span class="badge badge-green">Safe</span></td><td style="color:var(--ink-4);font-size:12px">—</td><td>Yesterday</td><td><span class="badge badge-yellow">Low</span></td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></div></td></tr>
          <tr style="background:var(--red-tint)"><td><span class="blood-tag">B−</span></td><td><b>30</b></td><td><div class="progress-bar"><div class="progress-fill danger" style="width:12%"></div></div></td><td>50 units</td><td><span class="badge badge-red">Critical</span></td><td style="color:var(--red);font-size:12px;font-weight:600">6 units — Mar 25 ⚠</td><td>Today</td><td><span class="badge badge-red">Critical</span></td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></div></td></tr>
          <tr><td><span class="blood-tag" style="color:var(--green);background:var(--green-tint);border-color:var(--green-border)">O+</span></td><td><b>520</b></td><td><div class="progress-bar"><div class="progress-fill" style="width:100%"></div></div></td><td>80 units</td><td><span class="badge badge-green">Safe</span></td><td style="color:var(--ink-4);font-size:12px">—</td><td>Today</td><td><span class="badge badge-green">Normal</span></td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></div></td></tr>
        </tbody>
      </table></div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════
     BLOOD REQUESTS
════════════════════════════════════ -->
<div class="page" id="page-requests">
  <nav class="sidebar">
    <a class="sb-brand" onclick="showPage('dashboard')"><div class="sb-brand-icon"><i class="fas fa-tint"></i></div><div class="sb-brand-text"><b>BBMIS</b><small>Pagamutan ng Dasmariñas</small></div></a>
    <div class="sb-section"><span class="sb-section-label">Main</span>
      <a class="sb-link" onclick="showPage('dashboard')"><i class="fas fa-chart-pie"></i> Dashboard</a>
      <a class="sb-link" onclick="showPage('donors')"><i class="fas fa-users"></i> Donor Management</a>
      <a class="sb-link" onclick="showPage('inventory')"><i class="fas fa-tint"></i> Blood Inventory</a>
      <a class="sb-link active"><i class="fas fa-file-medical"></i> Blood Requests <span class="sb-badge">4</span></a>
      <a class="sb-link" onclick="showPage('screening')"><i class="fas fa-vial"></i> Screening Records</a>
      <a class="sb-link" onclick="showPage('release')"><i class="fas fa-box-open"></i> Blood Release</a>
    </div>
    <div class="sb-section"><span class="sb-section-label">Reports</span><a class="sb-link" onclick="showPage('reports')"><i class="fas fa-chart-bar"></i> Reports &amp; Analytics</a><a class="sb-link" onclick="showPage('alerts')"><i class="fas fa-bell"></i> Alerts <span class="sb-badge">5</span></a></div>
    <div class="sb-section"><span class="sb-section-label">Admin only</span><a class="sb-link" onclick="showPage('staff')"><i class="fas fa-user-cog"></i> Staff Management</a></div>
    <div class="sb-bottom"><div class="sb-user"><div class="sb-avatar">JD</div><div class="sb-user-info"><b>Juan Dela Cruz</b><small>Admin</small></div><span class="sb-logout" onclick="showPage('login')"><i class="fas fa-sign-out-alt"></i></span></div></div>
  </nav>
  <div class="main">
    <div class="topbar"><div class="topbar-left"><div class="topbar-title">Blood Requests</div><div class="topbar-breadcrumb">Home / Blood Requests</div></div><div class="topbar-right"><div class="topbar-btn"><i class="fas fa-bell"></i><span class="notif-dot"></span></div><div class="topbar-btn"><i class="fas fa-user-circle"></i></div></div></div>
    <div class="content">
      <div class="page-header"><div><h2>Blood requests</h2><p>Review, approve, fulfill or reject hospital ward requests</p></div><div style="display:flex;gap:10px"><button class="btn btn-outline"><i class="fas fa-download"></i> Export</button><button class="btn btn-primary" onclick="openModal('newReqModal')"><i class="fas fa-plus"></i> New request</button></div></div>
      <div class="stat-grid">
        <div class="stat-card border-yellow"><div class="stat-icon si-yellow"><i class="fas fa-hourglass-half"></i></div><div><div class="stat-val">4</div><div class="stat-lbl">Pending</div></div></div>
        <div class="stat-card border-green"><div class="stat-icon si-green"><i class="fas fa-check-circle"></i></div><div><div class="stat-val">38</div><div class="stat-lbl">Approved</div></div></div>
        <div class="stat-card border-blue"><div class="stat-icon si-blue"><i class="fas fa-box-open"></i></div><div><div class="stat-val">30</div><div class="stat-lbl">Fulfilled</div></div></div>
        <div class="stat-card border-red"><div class="stat-icon si-red"><i class="fas fa-times-circle"></i></div><div><div class="stat-val">5</div><div class="stat-lbl">Rejected</div></div></div>
      </div>
      <!-- Tabs -->
      <div style="display:flex;gap:0;margin-bottom:16px;border-bottom:2px solid var(--line)">
        <div style="font-size:13.5px;font-weight:600;color:var(--green);padding:10px 18px;border-bottom:2px solid var(--green);margin-bottom:-2px;cursor:pointer">All requests</div>
        <div style="font-size:13.5px;font-weight:500;color:var(--ink-3);padding:10px 18px;cursor:pointer">Pending (4)</div>
        <div style="font-size:13.5px;font-weight:500;color:var(--ink-3);padding:10px 18px;cursor:pointer">Approved</div>
        <div style="font-size:13.5px;font-weight:500;color:var(--ink-3);padding:10px 18px;cursor:pointer">Fulfilled</div>
        <div style="font-size:13.5px;font-weight:500;color:var(--ink-3);padding:10px 18px;cursor:pointer">Rejected</div>
      </div>
      <div class="filters"><div class="search-wrap"><i class="fas fa-search"></i><input placeholder="Search by request ID or ward…"></div><select class="filter-select"><option>All blood types</option><option>O−</option><option>A+</option><option>B+</option></select><select class="filter-select"><option>All priorities</option><option>Urgent</option><option>High</option><option>Normal</option></select></div>
      <div class="card"><table>
        <thead><tr><th>Request ID</th><th>Ward / Requester</th><th>Blood type</th><th>Units</th><th>Priority</th><th>Status</th><th>Workflow</th><th>Submitted</th><th>Actions</th></tr></thead>
        <tbody>
          <tr><td><b>#REQ-0046</b></td><td>Emergency Ward<br><small style="color:var(--ink-4)">Dr. Mendoza</small></td><td><span class="blood-tag">O−</span></td><td>5 units</td><td><span class="badge badge-red">Urgent</span></td><td><span class="badge badge-yellow">Pending</span></td><td><div class="pipeline"><div class="pipe-step pipe-done"><i class="fas fa-check" style="font-size:8px"></i> Submitted</div><div class="pipe-step pipe-active"><i class="fas fa-clock" style="font-size:8px"></i> Review</div><div class="pipe-step pipe-idle">Approved</div><div class="pipe-step pipe-idle">Fulfilled</div></div></td><td style="white-space:nowrap;font-size:12px">Today 9:41 AM</td><td><div style="display:flex;gap:5px"><button class="btn-approve" onclick="showToast('Request REQ-0046 approved!',true)"><i class="fas fa-check"></i> Approve</button><button class="btn-reject" onclick="showToast('Request rejected.',false)"><i class="fas fa-times"></i> Reject</button><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button></div></td></tr>
          <tr><td><b>#REQ-0045</b></td><td>Surgery Dept.<br><small style="color:var(--ink-4)">Dr. Reyes</small></td><td><span class="blood-tag" style="color:var(--blue);background:var(--blue-tint);border-color:var(--blue-border)">A+</span></td><td>3 units</td><td><span class="badge badge-yellow">High</span></td><td><span class="badge badge-yellow">Pending</span></td><td><div class="pipeline"><div class="pipe-step pipe-done"><i class="fas fa-check" style="font-size:8px"></i> Submitted</div><div class="pipe-step pipe-active"><i class="fas fa-clock" style="font-size:8px"></i> Review</div><div class="pipe-step pipe-idle">Approved</div><div class="pipe-step pipe-idle">Fulfilled</div></div></td><td style="white-space:nowrap;font-size:12px">Today 8:20 AM</td><td><div style="display:flex;gap:5px"><button class="btn-approve"><i class="fas fa-check"></i> Approve</button><button class="btn-reject"><i class="fas fa-times"></i> Reject</button><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button></div></td></tr>
          <tr><td><b>#REQ-0042</b></td><td>Surgery Dept.<br><small style="color:var(--ink-4)">Dr. Reyes</small></td><td><span class="blood-tag" style="color:var(--blue);background:var(--blue-tint);border-color:var(--blue-border)">A+</span></td><td>4 units</td><td><span class="badge badge-yellow">High</span></td><td><span class="badge badge-green">Approved</span></td><td><div class="pipeline"><div class="pipe-step pipe-done"><i class="fas fa-check" style="font-size:8px"></i> Submitted</div><div class="pipe-step pipe-done"><i class="fas fa-check" style="font-size:8px"></i> Review</div><div class="pipe-step pipe-active"><i class="fas fa-clock" style="font-size:8px"></i> Approved</div><div class="pipe-step pipe-idle">Fulfilled</div></div></td><td style="white-space:nowrap;font-size:12px">Mar 20</td><td><button class="btn-approve"><i class="fas fa-box-open"></i> Fulfill</button></td></tr>
        </tbody>
      </table></div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════
     SCREENING RECORDS
════════════════════════════════════ -->
<div class="page" id="page-screening">
  <nav class="sidebar">
    <a class="sb-brand" onclick="showPage('dashboard')"><div class="sb-brand-icon"><i class="fas fa-tint"></i></div><div class="sb-brand-text"><b>BBMIS</b><small>Pagamutan ng Dasmariñas</small></div></a>
    <div class="sb-section"><span class="sb-section-label">Main</span>
      <a class="sb-link" onclick="showPage('dashboard')"><i class="fas fa-chart-pie"></i> Dashboard</a>
      <a class="sb-link" onclick="showPage('donors')"><i class="fas fa-users"></i> Donor Management</a>
      <a class="sb-link" onclick="showPage('inventory')"><i class="fas fa-tint"></i> Blood Inventory</a>
      <a class="sb-link" onclick="showPage('requests')"><i class="fas fa-file-medical"></i> Blood Requests <span class="sb-badge">4</span></a>
      <a class="sb-link active"><i class="fas fa-vial"></i> Screening Records</a>
      <a class="sb-link" onclick="showPage('release')"><i class="fas fa-box-open"></i> Blood Release</a>
    </div>
    <div class="sb-section"><span class="sb-section-label">Reports</span><a class="sb-link" onclick="showPage('reports')"><i class="fas fa-chart-bar"></i> Reports &amp; Analytics</a><a class="sb-link" onclick="showPage('alerts')"><i class="fas fa-bell"></i> Alerts <span class="sb-badge">5</span></a></div>
    <div class="sb-section"><span class="sb-section-label">Admin only</span><a class="sb-link" onclick="showPage('staff')"><i class="fas fa-user-cog"></i> Staff Management</a></div>
    <div class="sb-bottom"><div class="sb-user"><div class="sb-avatar">JD</div><div class="sb-user-info"><b>Juan Dela Cruz</b><small>Admin</small></div><span class="sb-logout" onclick="showPage('login')"><i class="fas fa-sign-out-alt"></i></span></div></div>
  </nav>
  <div class="main">
    <div class="topbar"><div class="topbar-left"><div class="topbar-title">Screening Records</div><div class="topbar-breadcrumb">Home / Screening</div></div><div class="topbar-right"><div class="topbar-btn"><i class="fas fa-bell"></i><span class="notif-dot"></span></div><div class="topbar-btn"><i class="fas fa-user-circle"></i></div></div></div>
    <div class="content">
      <div class="page-header"><div><h2>Screening records</h2><p>Pre-donation health screening results for all donors</p></div><button class="btn btn-primary" onclick="openModal('addScreenModal')"><i class="fas fa-plus"></i> Add screening</button></div>
      <div class="stat-grid">
        <div class="stat-card border-green"><div class="stat-icon si-green"><i class="fas fa-check-circle"></i></div><div><div class="stat-val">1,842</div><div class="stat-lbl">Passed screening</div></div></div>
        <div class="stat-card border-red"><div class="stat-icon si-red"><i class="fas fa-times-circle"></i></div><div><div class="stat-val">124</div><div class="stat-lbl">Failed screening</div></div></div>
        <div class="stat-card border-yellow"><div class="stat-icon si-yellow"><i class="fas fa-hourglass-half"></i></div><div><div class="stat-val">18</div><div class="stat-lbl">Pending review</div></div></div>
        <div class="stat-card border-blue"><div class="stat-icon si-blue"><i class="fas fa-percentage"></i></div><div><div class="stat-val">93.7%</div><div class="stat-lbl">Pass rate this month</div></div></div>
      </div>
      <div class="filters"><div class="search-wrap"><i class="fas fa-search"></i><input placeholder="Search by donor name or ID…"></div><select class="filter-select"><option>All results</option><option>Passed</option><option>Failed</option><option>Pending</option></select><select class="filter-select"><option>All blood types</option><option>A+</option><option>A−</option><option>B+</option><option>B−</option><option>AB+</option><option>AB−</option><option>O+</option><option>O−</option></select><select class="filter-select"><option>This month</option><option>Last month</option><option>Last 3 months</option></select></div>
      <div class="card"><table>
        <thead><tr><th>Donor</th><th>Donor ID</th><th>Blood type</th><th>Screening date</th><th>Hemoglobin</th><th>Blood pressure</th><th>Weight</th><th>HIV/Hep</th><th>Result</th><th>Screened by</th><th>Actions</th></tr></thead>
        <tbody>
          <tr><td><div class="avatar-cell"><div class="tbl-avatar">MS</div><div><div class="tbl-name">Maria Santos</div><div class="tbl-sub">DNR-0001</div></div></div></td><td>SCR-0101</td><td><span class="blood-tag">O+</span></td><td>Mar 15, 2025</td><td style="color:var(--green);font-weight:600">13.2 g/dL ✓</td><td style="color:var(--green);font-weight:600">110/70 ✓</td><td style="color:var(--green);font-weight:600">58 kg ✓</td><td><span class="badge badge-green">Non-reactive</span></td><td><span class="screen-status screen-pass"><i class="fas fa-check-circle"></i> Passed</span></td><td>Ana Reyes</td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-print"></i></button></div></td></tr>
          <tr><td><div class="avatar-cell"><div class="tbl-avatar">AC</div><div><div class="tbl-name">Ana Cruz</div><div class="tbl-sub">DNR-0003</div></div></div></td><td>SCR-0100</td><td><span class="blood-tag" style="color:var(--green);background:var(--green-tint);border-color:var(--green-border)">B+</span></td><td>Jan 10, 2025</td><td style="color:var(--red);font-weight:600">11.8 g/dL ✗</td><td style="color:var(--green);font-weight:600">115/75 ✓</td><td style="color:var(--green);font-weight:600">55 kg ✓</td><td><span class="badge badge-green">Non-reactive</span></td><td><span class="screen-status screen-fail"><i class="fas fa-times-circle"></i> Failed</span></td><td>Pedro Bautista</td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-print"></i></button></div></td></tr>
          <tr><td><div class="avatar-cell"><div class="tbl-avatar">PL</div><div><div class="tbl-name">Pedro Lopez</div><div class="tbl-sub">DNR-0004</div></div></div></td><td>SCR-0099</td><td><span class="blood-tag" style="color:var(--ink-3);background:#F3F4F6;border-color:#E5E7EB">AB−</span></td><td>Jan 25, 2025</td><td style="color:var(--green);font-weight:600">14.5 g/dL ✓</td><td style="color:var(--yellow-dark);font-weight:600">130/85 ⚠</td><td style="color:var(--green);font-weight:600">72 kg ✓</td><td><span class="badge badge-green">Non-reactive</span></td><td><span class="screen-status screen-pass"><i class="fas fa-check-circle"></i> Passed</span></td><td>Ana Reyes</td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-print"></i></button></div></td></tr>
          <tr style="background:var(--yellow-tint)"><td><div class="avatar-cell"><div class="tbl-avatar">JR</div><div><div class="tbl-name">Jose Reyes</div><div class="tbl-sub">DNR-0002</div></div></div></td><td>SCR-0103</td><td><span class="blood-tag" style="color:var(--blue);background:var(--blue-tint);border-color:var(--blue-border)">A+</span></td><td>Mar 20, 2025</td><td style="color:var(--ink-3)">—</td><td style="color:var(--ink-3)">—</td><td style="color:var(--ink-3)">—</td><td><span class="badge badge-yellow">Pending</span></td><td><span class="screen-status screen-pending"><i class="fas fa-hourglass-half"></i> Pending</span></td><td>—</td><td><div style="display:flex;gap:5px"><button class="btn btn-primary btn-sm">Screen now</button><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button></div></td></tr>
        </tbody>
      </table></div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════
     BLOOD RELEASE
════════════════════════════════════ -->
<div class="page" id="page-release">
  <nav class="sidebar">
    <a class="sb-brand" onclick="showPage('dashboard')"><div class="sb-brand-icon"><i class="fas fa-tint"></i></div><div class="sb-brand-text"><b>BBMIS</b><small>Pagamutan ng Dasmariñas</small></div></a>
    <div class="sb-section"><span class="sb-section-label">Main</span>
      <a class="sb-link" onclick="showPage('dashboard')"><i class="fas fa-chart-pie"></i> Dashboard</a>
      <a class="sb-link" onclick="showPage('donors')"><i class="fas fa-users"></i> Donor Management</a>
      <a class="sb-link" onclick="showPage('inventory')"><i class="fas fa-tint"></i> Blood Inventory</a>
      <a class="sb-link" onclick="showPage('requests')"><i class="fas fa-file-medical"></i> Blood Requests <span class="sb-badge">4</span></a>
      <a class="sb-link" onclick="showPage('screening')"><i class="fas fa-vial"></i> Screening Records</a>
      <a class="sb-link active"><i class="fas fa-box-open"></i> Blood Release</a>
    </div>
    <div class="sb-section"><span class="sb-section-label">Reports</span><a class="sb-link" onclick="showPage('reports')"><i class="fas fa-chart-bar"></i> Reports &amp; Analytics</a><a class="sb-link" onclick="showPage('alerts')"><i class="fas fa-bell"></i> Alerts <span class="sb-badge">5</span></a></div>
    <div class="sb-section"><span class="sb-section-label">Admin only</span><a class="sb-link" onclick="showPage('staff')"><i class="fas fa-user-cog"></i> Staff Management</a></div>
    <div class="sb-bottom"><div class="sb-user"><div class="sb-avatar">JD</div><div class="sb-user-info"><b>Juan Dela Cruz</b><small>Admin</small></div><span class="sb-logout" onclick="showPage('login')"><i class="fas fa-sign-out-alt"></i></span></div></div>
  </nav>
  <div class="main">
    <div class="topbar"><div class="topbar-left"><div class="topbar-title">Blood Release</div><div class="topbar-breadcrumb">Home / Blood Release</div></div><div class="topbar-right"><div class="topbar-btn"><i class="fas fa-bell"></i><span class="notif-dot"></span></div><div class="topbar-btn"><i class="fas fa-user-circle"></i></div></div></div>
    <div class="content">
      <div class="page-header"><div><h2>Blood release</h2><p>Track and log blood units released to hospital wards</p></div><button class="btn btn-primary" onclick="openModal('addReleaseModal')"><i class="fas fa-plus"></i> Log release</button></div>
      <div class="stat-grid">
        <div class="stat-card border-green"><div class="stat-icon si-green"><i class="fas fa-box-open"></i></div><div><div class="stat-val">30</div><div class="stat-lbl">Released this month</div></div></div>
        <div class="stat-card border-blue"><div class="stat-icon si-blue"><i class="fas fa-tint"></i></div><div><div class="stat-val">87</div><div class="stat-lbl">Units released</div></div></div>
        <div class="stat-card border-yellow"><div class="stat-icon si-yellow"><i class="fas fa-hospital"></i></div><div><div class="stat-val">6</div><div class="stat-lbl">Wards served</div></div></div>
        <div class="stat-card border-green"><div class="stat-icon si-orange"><i class="fas fa-clock"></i></div><div><div class="stat-val">1.8 hrs</div><div class="stat-lbl">Avg. release time</div></div></div>
      </div>
      <!-- Approved requests ready for release -->
      <div class="section-div"><span>Ready for release (Approved requests)</span></div>
      <div class="release-card">
        <div class="release-ico"><i class="fas fa-tint"></i></div>
        <div style="flex:1">
          <div style="font-size:14px;font-weight:600;color:var(--ink)">#REQ-0042 — Surgery Dept.</div>
          <div style="font-size:12.5px;color:var(--ink-3);margin-top:3px">4 units of <b>A+</b> · Approved by Admin Dela Cruz · Dr. Reyes</div>
          <div style="font-size:11.5px;color:var(--ink-4);margin-top:3px">Approved: Mar 20 · Batch: BTH-0001</div>
        </div>
        <button class="btn btn-primary" onclick="showToast('Blood released to Surgery Dept.!',true)"><i class="fas fa-box-open"></i> Release now</button>
      </div>
      <!-- Release log table -->
      <div class="section-div"><span>Release history</span></div>
      <div class="card"><table>
        <thead><tr><th>Release ID</th><th>Request ref</th><th>Ward / Recipient</th><th>Blood type</th><th>Units</th><th>Batch</th><th>Released by</th><th>Released at</th><th>Status</th></tr></thead>
        <tbody>
          <tr><td><b>REL-0018</b></td><td>REQ-0041</td><td>Emergency Ward — Dr. Mendoza</td><td><span class="blood-tag">O−</span></td><td>2 units</td><td>BTH-0010</td><td>Admin: Dela Cruz</td><td>Mar 19, 8:45 AM</td><td><span class="badge badge-green">Completed</span></td></tr>
          <tr><td><b>REL-0017</b></td><td>REQ-0039</td><td>ICU — Nurse Bautista</td><td><span class="blood-tag" style="color:var(--green);background:var(--green-tint);border-color:var(--green-border)">B+</span></td><td>3 units</td><td>BTH-0004</td><td>Admin: Dela Cruz</td><td>Mar 17, 2:00 PM</td><td><span class="badge badge-green">Completed</span></td></tr>
          <tr><td><b>REL-0016</b></td><td>REQ-0038</td><td>Maternity Ward — Nurse Garcia</td><td><span class="blood-tag" style="color:var(--blue);background:var(--blue-tint);border-color:var(--blue-border)">A+</span></td><td>2 units</td><td>BTH-0001</td><td>Staff: Reyes</td><td>Mar 15, 10:30 AM</td><td><span class="badge badge-green">Completed</span></td></tr>
        </tbody>
      </table></div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════
     REPORTS
════════════════════════════════════ -->
<div class="page" id="page-reports">
  <nav class="sidebar">
    <a class="sb-brand" onclick="showPage('dashboard')"><div class="sb-brand-icon"><i class="fas fa-tint"></i></div><div class="sb-brand-text"><b>BBMIS</b><small>Pagamutan ng Dasmariñas</small></div></a>
    <div class="sb-section"><span class="sb-section-label">Main</span>
      <a class="sb-link" onclick="showPage('dashboard')"><i class="fas fa-chart-pie"></i> Dashboard</a>
      <a class="sb-link" onclick="showPage('donors')"><i class="fas fa-users"></i> Donor Management</a>
      <a class="sb-link" onclick="showPage('inventory')"><i class="fas fa-tint"></i> Blood Inventory</a>
      <a class="sb-link" onclick="showPage('requests')"><i class="fas fa-file-medical"></i> Blood Requests <span class="sb-badge">4</span></a>
      <a class="sb-link" onclick="showPage('screening')"><i class="fas fa-vial"></i> Screening Records</a>
      <a class="sb-link" onclick="showPage('release')"><i class="fas fa-box-open"></i> Blood Release</a>
    </div>
    <div class="sb-section"><span class="sb-section-label">Reports</span><a class="sb-link active"><i class="fas fa-chart-bar"></i> Reports &amp; Analytics</a><a class="sb-link" onclick="showPage('alerts')"><i class="fas fa-bell"></i> Alerts <span class="sb-badge">5</span></a></div>
    <div class="sb-section"><span class="sb-section-label">Admin only</span><a class="sb-link" onclick="showPage('staff')"><i class="fas fa-user-cog"></i> Staff Management</a></div>
    <div class="sb-bottom"><div class="sb-user"><div class="sb-avatar">JD</div><div class="sb-user-info"><b>Juan Dela Cruz</b><small>Admin</small></div><span class="sb-logout" onclick="showPage('login')"><i class="fas fa-sign-out-alt"></i></span></div></div>
  </nav>
  <div class="main">
    <div class="topbar"><div class="topbar-left"><div class="topbar-title">Reports &amp; Analytics</div><div class="topbar-breadcrumb">Home / Reports</div></div><div class="topbar-right"><div class="topbar-btn"><i class="fas fa-bell"></i><span class="notif-dot"></span></div><div class="topbar-btn"><i class="fas fa-user-circle"></i></div></div></div>
    <div class="content">
      <div class="page-header"><div><h2>Reports &amp; analytics</h2><p>Generate and export system reports — Admin only</p></div><div style="display:flex;gap:10px"><select class="filter-select"><option>This month</option><option>Last month</option><option>Last 3 months</option><option>This year</option></select><button class="btn btn-outline"><i class="fas fa-file-csv"></i> Export CSV</button><button class="btn btn-primary"><i class="fas fa-file-pdf"></i> Export PDF</button></div></div>
      <!-- Report type cards -->
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:20px">
        <div style="background:var(--white);border:2px solid var(--green-border);border-radius:13px;padding:20px;cursor:pointer">
          <div style="width:44px;height:44px;border-radius:12px;background:var(--green-tint);display:flex;align-items:center;justify-content:center;margin-bottom:12px;font-size:18px;color:var(--green)"><i class="fas fa-tint"></i></div>
          <div style="font-size:14.5px;font-weight:700;color:var(--ink);margin-bottom:5px">Donation report</div>
          <div style="font-size:12.5px;color:var(--ink-3);line-height:1.5">Monthly donor activity, new registrations, donation frequency</div>
        </div>
        <div style="background:var(--white);border:1px solid var(--line);border-radius:13px;padding:20px;cursor:pointer">
          <div style="width:44px;height:44px;border-radius:12px;background:var(--blue-tint);display:flex;align-items:center;justify-content:center;margin-bottom:12px;font-size:18px;color:var(--blue)"><i class="fas fa-boxes"></i></div>
          <div style="font-size:14.5px;font-weight:700;color:var(--ink);margin-bottom:5px">Inventory report</div>
          <div style="font-size:12.5px;color:var(--ink-3);line-height:1.5">Blood units added, used, and expired by type over time</div>
        </div>
        <div style="background:var(--white);border:1px solid var(--line);border-radius:13px;padding:20px;cursor:pointer">
          <div style="width:44px;height:44px;border-radius:12px;background:var(--yellow-tint);display:flex;align-items:center;justify-content:center;margin-bottom:12px;font-size:18px;color:var(--yellow-dark)"><i class="fas fa-file-medical"></i></div>
          <div style="font-size:14.5px;font-weight:700;color:var(--ink);margin-bottom:5px">Request report</div>
          <div style="font-size:12.5px;color:var(--ink-3);line-height:1.5">Request history, approval rates, and ward usage statistics</div>
        </div>
      </div>
      <!-- Stats -->
      <div class="stat-grid">
        <div class="stat-card border-green"><div class="stat-icon si-green"><i class="fas fa-tint"></i></div><div><div class="stat-val">617</div><div class="stat-lbl">Total donations (2025)</div><div class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> +12% vs last month</div></div></div>
        <div class="stat-card border-blue"><div class="stat-icon si-blue"><i class="fas fa-users"></i></div><div><div class="stat-val">142</div><div class="stat-lbl">Active donors</div><div class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> +8% vs last month</div></div></div>
        <div class="stat-card border-green"><div class="stat-icon si-green"><i class="fas fa-check-circle"></i></div><div><div class="stat-val">94%</div><div class="stat-lbl">Request fulfillment rate</div><div class="stat-trend trend-up"><i class="fas fa-arrow-up"></i> +3% vs last month</div></div></div>
        <div class="stat-card border-yellow"><div class="stat-icon si-yellow"><i class="fas fa-exclamation-triangle"></i></div><div><div class="stat-val">8</div><div class="stat-lbl">Critical stock alerts</div><div class="stat-trend trend-down"><i class="fas fa-arrow-up"></i> 2 more than last month</div></div></div>
      </div>
      <!-- Charts -->
      <div class="two-col">
        <div class="card"><div class="card-head"><div><h3><i class="fas fa-chart-bar"></i> Donations per month</h3><p>Total units collected — 2025</p></div></div><div style="padding:16px 18px"><canvas id="reportChart" style="max-height:240px"></canvas></div></div>
        <div class="card"><div class="card-head"><div><h3><i class="fas fa-chart-pie"></i> Blood type distribution</h3><p>Current inventory breakdown</p></div></div><div style="padding:16px 18px"><canvas id="donutChart" style="max-height:240px"></canvas></div></div>
      </div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════
     ALERTS
════════════════════════════════════ -->
<div class="page" id="page-alerts">
  <nav class="sidebar">
    <a class="sb-brand" onclick="showPage('dashboard')"><div class="sb-brand-icon"><i class="fas fa-tint"></i></div><div class="sb-brand-text"><b>BBMIS</b><small>Pagamutan ng Dasmariñas</small></div></a>
    <div class="sb-section"><span class="sb-section-label">Main</span>
      <a class="sb-link" onclick="showPage('dashboard')"><i class="fas fa-chart-pie"></i> Dashboard</a>
      <a class="sb-link" onclick="showPage('donors')"><i class="fas fa-users"></i> Donor Management</a>
      <a class="sb-link" onclick="showPage('inventory')"><i class="fas fa-tint"></i> Blood Inventory</a>
      <a class="sb-link" onclick="showPage('requests')"><i class="fas fa-file-medical"></i> Blood Requests <span class="sb-badge">4</span></a>
      <a class="sb-link" onclick="showPage('screening')"><i class="fas fa-vial"></i> Screening Records</a>
      <a class="sb-link" onclick="showPage('release')"><i class="fas fa-box-open"></i> Blood Release</a>
    </div>
    <div class="sb-section"><span class="sb-section-label">Reports</span><a class="sb-link" onclick="showPage('reports')"><i class="fas fa-chart-bar"></i> Reports &amp; Analytics</a><a class="sb-link active"><i class="fas fa-bell"></i> Alerts <span class="sb-badge">5</span></a></div>
    <div class="sb-section"><span class="sb-section-label">Admin only</span><a class="sb-link" onclick="showPage('staff')"><i class="fas fa-user-cog"></i> Staff Management</a></div>
    <div class="sb-bottom"><div class="sb-user"><div class="sb-avatar">JD</div><div class="sb-user-info"><b>Juan Dela Cruz</b><small>Admin</small></div><span class="sb-logout" onclick="showPage('login')"><i class="fas fa-sign-out-alt"></i></span></div></div>
  </nav>
  <div class="main">
    <div class="topbar"><div class="topbar-left"><div class="topbar-title">Alerts &amp; Notifications</div><div class="topbar-breadcrumb">Home / Alerts</div></div><div class="topbar-right"><div class="topbar-btn"><i class="fas fa-bell"></i><span class="notif-dot"></span></div><div class="topbar-btn"><i class="fas fa-user-circle"></i></div></div></div>
    <div class="content">
      <div class="page-header"><div><h2>Alerts &amp; notifications</h2><p>System alerts for low stock, expiring units, and pending requests</p></div><div style="display:flex;gap:10px"><button class="btn btn-outline"><i class="fas fa-check-double"></i> Mark all read</button><button class="btn btn-outline"><i class="fas fa-bell-slash"></i> Dismiss all</button></div></div>
      <div class="stat-grid">
        <div class="stat-card border-red"><div class="stat-icon si-red"><i class="fas fa-exclamation-circle"></i></div><div><div class="stat-val">2</div><div class="stat-lbl">Critical</div></div></div>
        <div class="stat-card border-yellow"><div class="stat-icon si-yellow"><i class="fas fa-exclamation-triangle"></i></div><div><div class="stat-val">3</div><div class="stat-lbl">Warnings</div></div></div>
        <div class="stat-card border-blue"><div class="stat-icon si-blue"><i class="fas fa-info-circle"></i></div><div><div class="stat-val">4</div><div class="stat-lbl">Info</div></div></div>
        <div class="stat-card border-green"><div class="stat-icon si-green"><i class="fas fa-bell-slash"></i></div><div><div class="stat-val">18</div><div class="stat-lbl">Dismissed</div></div></div>
      </div>
      <!-- Tabs -->
      <div style="display:flex;gap:0;margin-bottom:16px;border-bottom:2px solid var(--line)">
        <div style="font-size:13.5px;font-weight:600;color:var(--green);padding:10px 18px;border-bottom:2px solid var(--green);margin-bottom:-2px;cursor:pointer">All alerts</div>
        <div style="font-size:13.5px;font-weight:500;color:var(--ink-3);padding:10px 18px;cursor:pointer">Critical (2)</div>
        <div style="font-size:13.5px;font-weight:500;color:var(--ink-3);padding:10px 18px;cursor:pointer">Warnings (3)</div>
        <div style="font-size:13.5px;font-weight:500;color:var(--ink-3);padding:10px 18px;cursor:pointer">Info (4)</div>
        <div style="font-size:13.5px;font-weight:500;color:var(--ink-3);padding:10px 18px;cursor:pointer">Dismissed</div>
      </div>
      <div class="section-div"><span>Critical</span></div>
      <div class="alert-card critical"><div class="al-icon al-icon-red"><i class="fas fa-exclamation-circle"></i></div><div class="al-body"><div class="al-title">B− blood type critically low</div><div class="al-desc">Current stock: 30 units. Minimum threshold is 50 units. Immediate restocking required.</div><div class="al-meta"><i class="fas fa-clock"></i> Today at 6:02 AM · System auto-alert</div></div><div class="al-actions"><span class="badge badge-red">Critical</span><button class="btn btn-outline btn-sm" onclick="showPage('inventory')">View inventory</button><button class="btn btn-outline btn-sm" onclick="showToast('Alert resolved.',true)"><i class="fas fa-check"></i></button><button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div></div>
      <div class="alert-card critical"><div class="al-icon al-icon-red"><i class="fas fa-exclamation-circle"></i></div><div class="al-body"><div class="al-title">AB− blood type critically low</div><div class="al-desc">Current stock: 20 units. Minimum threshold is 40 units. AB− is the rarest blood type.</div><div class="al-meta"><i class="fas fa-clock"></i> Today at 6:02 AM · System auto-alert</div></div><div class="al-actions"><span class="badge badge-red">Critical</span><button class="btn btn-outline btn-sm" onclick="showPage('inventory')">View inventory</button><button class="btn btn-outline btn-sm"><i class="fas fa-check"></i></button><button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div></div>
      <div class="section-div"><span>Warning</span></div>
      <div class="alert-card warning"><div class="al-icon al-icon-yellow"><i class="fas fa-clock"></i></div><div class="al-body"><div class="al-title">12 units of A+ expiring in 3 days</div><div class="al-desc">Batch BTH-0002 expires on March 27, 2025. Prioritize for release or disposal.</div><div class="al-meta"><i class="fas fa-clock"></i> Today at 6:00 AM · System auto-alert · Batch BTH-0002</div></div><div class="al-actions"><span class="badge badge-yellow">Expiring</span><button class="btn btn-outline btn-sm" onclick="showPage('inventory')">View units</button><button class="btn btn-outline btn-sm"><i class="fas fa-check"></i></button><button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div></div>
      <div class="alert-card warning"><div class="al-icon al-icon-yellow"><i class="fas fa-file-medical"></i></div><div class="al-body"><div class="al-title">4 blood requests pending approval</div><div class="al-desc">Including 1 Urgent from Emergency Ward. Pending for over 24 hours.</div><div class="al-meta"><i class="fas fa-clock"></i> Today at 9:41 AM · System auto-alert</div></div><div class="al-actions"><span class="badge badge-yellow">Pending</span><button class="btn btn-outline btn-sm" onclick="showPage('requests')">Review now</button><button class="btn btn-outline btn-sm"><i class="fas fa-check"></i></button><button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div></div>
      <div class="section-div"><span>Info</span></div>
      <div class="alert-card info"><div class="al-icon al-icon-green"><i class="fas fa-user-check"></i></div><div class="al-body"><div class="al-title">Deferral auto-lifted — Ana Cruz (DNR-0003) is now Eligible</div><div class="al-desc">The deferral period ended today. Status automatically updated to Eligible.</div><div class="al-meta"><i class="fas fa-clock"></i> Today at 12:00 AM · System auto-lift · DNR-0003</div></div><div class="al-actions"><span class="badge badge-green">Auto-lifted</span><button class="btn btn-outline btn-sm" onclick="showPage('donors')">View donor</button><button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div></div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════
     STAFF MANAGEMENT
════════════════════════════════════ -->
<div class="page" id="page-staff">
  <nav class="sidebar">
    <a class="sb-brand" onclick="showPage('dashboard')"><div class="sb-brand-icon"><i class="fas fa-tint"></i></div><div class="sb-brand-text"><b>BBMIS</b><small>Pagamutan ng Dasmariñas</small></div></a>
    <div class="sb-section"><span class="sb-section-label">Main</span>
      <a class="sb-link" onclick="showPage('dashboard')"><i class="fas fa-chart-pie"></i> Dashboard</a>
      <a class="sb-link" onclick="showPage('donors')"><i class="fas fa-users"></i> Donor Management</a>
      <a class="sb-link" onclick="showPage('inventory')"><i class="fas fa-tint"></i> Blood Inventory</a>
      <a class="sb-link" onclick="showPage('requests')"><i class="fas fa-file-medical"></i> Blood Requests <span class="sb-badge">4</span></a>
      <a class="sb-link" onclick="showPage('screening')"><i class="fas fa-vial"></i> Screening Records</a>
      <a class="sb-link" onclick="showPage('release')"><i class="fas fa-box-open"></i> Blood Release</a>
    </div>
    <div class="sb-section"><span class="sb-section-label">Reports</span><a class="sb-link" onclick="showPage('reports')"><i class="fas fa-chart-bar"></i> Reports &amp; Analytics</a><a class="sb-link" onclick="showPage('alerts')"><i class="fas fa-bell"></i> Alerts <span class="sb-badge">5</span></a></div>
    <div class="sb-section"><span class="sb-section-label">Admin only</span><a class="sb-link active"><i class="fas fa-user-cog"></i> Staff Management</a></div>
    <div class="sb-bottom"><div class="sb-user"><div class="sb-avatar">JD</div><div class="sb-user-info"><b>Juan Dela Cruz</b><small>Admin</small></div><span class="sb-logout" onclick="showPage('login')"><i class="fas fa-sign-out-alt"></i></span></div></div>
  </nav>
  <div class="main">
    <div class="topbar"><div class="topbar-left"><div class="topbar-title">Staff Management</div><div class="topbar-breadcrumb">Home / Staff</div></div><div class="topbar-right"><div class="topbar-btn"><i class="fas fa-bell"></i><span class="notif-dot"></span></div><div class="topbar-btn"><i class="fas fa-user-circle"></i></div></div></div>
    <div class="content">
      <!-- Admin notice -->
      <div style="background:var(--green-tint);border:1px solid var(--green-border);border-radius:10px;padding:12px 16px;display:flex;align-items:center;gap:10px;margin-bottom:20px;font-size:13.5px;color:var(--green-dark)"><i class="fas fa-lock" style="font-size:14px;flex-shrink:0"></i> This module is visible to <b>&nbsp;Admins only.</b>&nbsp; Staff accounts cannot access this page.</div>
      <div class="page-header"><div><h2>Staff management</h2><p>Add, edit, manage staff accounts, roles, and permissions</p></div><button class="btn btn-primary" onclick="openModal('addStaffModal')"><i class="fas fa-plus"></i> Add staff</button></div>
      <div class="stat-grid">
        <div class="stat-card border-blue"><div class="stat-icon si-blue"><i class="fas fa-users"></i></div><div><div class="stat-val">12</div><div class="stat-lbl">Total staff</div></div></div>
        <div class="stat-card border-red"><div class="stat-icon si-red"><i class="fas fa-user-shield"></i></div><div><div class="stat-val">3</div><div class="stat-lbl">Admins</div></div></div>
        <div class="stat-card border-green"><div class="stat-icon si-green"><i class="fas fa-user-check"></i></div><div><div class="stat-val">11</div><div class="stat-lbl">Active</div></div></div>
        <div class="stat-card border-yellow"><div class="stat-icon si-yellow"><i class="fas fa-user-slash"></i></div><div><div class="stat-val">1</div><div class="stat-lbl">Deactivated</div></div></div>
      </div>
      <!-- Tabs -->
      <div style="display:flex;gap:0;margin-bottom:16px;border-bottom:2px solid var(--line)">
        <div style="font-size:13.5px;font-weight:600;color:var(--green);padding:10px 18px;border-bottom:2px solid var(--green);margin-bottom:-2px;cursor:pointer">Staff accounts</div>
        <div style="font-size:13.5px;font-weight:500;color:var(--ink-3);padding:10px 18px;cursor:pointer">Role permissions</div>
        <div style="font-size:13.5px;font-weight:500;color:var(--ink-3);padding:10px 18px;cursor:pointer">Activity log</div>
      </div>
      <div class="filters"><div class="search-wrap"><i class="fas fa-search"></i><input placeholder="Search by name or email…"></div><select class="filter-select"><option>All roles</option><option>Admin</option><option>Staff</option></select><select class="filter-select"><option>All statuses</option><option>Active</option><option>Deactivated</option></select></div>
      <div class="card"><table>
        <thead><tr><th>Staff member</th><th>Staff ID</th><th>Role</th><th>Contact</th><th>Last login</th><th>Date added</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
          <tr><td><div class="avatar-cell"><div class="tbl-avatar">JD</div><div><div class="tbl-name">Juan Dela Cruz</div><div class="tbl-sub">juan@pagamutandasma.gov.ph</div></div></div></td><td>STF-001</td><td><span class="badge badge-red">Admin</span></td><td>09XX-XXX-0001</td><td>Today, 10:42 AM</td><td>Jan 5, 2025</td><td><span class="badge badge-green">Active</span></td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-warning btn-sm"><i class="fas fa-ban"></i></button></div></td></tr>
          <tr><td><div class="avatar-cell"><div class="tbl-avatar">AR</div><div><div class="tbl-name">Ana Reyes</div><div class="tbl-sub">ana@pagamutandasma.gov.ph</div></div></div></td><td>STF-002</td><td><span class="badge badge-blue">Staff</span></td><td>09XX-XXX-0002</td><td>Today, 9:15 AM</td><td>Jan 10, 2025</td><td><span class="badge badge-green">Active</span></td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-warning btn-sm"><i class="fas fa-ban"></i></button></div></td></tr>
          <tr><td><div class="avatar-cell"><div class="tbl-avatar">MC</div><div><div class="tbl-name">Marco Cruz</div><div class="tbl-sub">marco@pagamutandasma.gov.ph</div></div></div></td><td>STF-003</td><td><span class="badge badge-red">Admin</span></td><td>09XX-XXX-0003</td><td>Mar 21, 2025</td><td>Feb 1, 2025</td><td><span class="badge badge-green">Active</span></td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button><button class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></button><button class="btn btn-warning btn-sm"><i class="fas fa-ban"></i></button></div></td></tr>
          <tr style="opacity:.6"><td><div class="avatar-cell"><div class="tbl-avatar" style="opacity:.5">LS</div><div><div class="tbl-name">Lita Santos</div><div class="tbl-sub">lita@pagamutandasma.gov.ph</div></div></div></td><td>STF-004</td><td><span class="badge badge-blue">Staff</span></td><td>09XX-XXX-0004</td><td>Feb 10, 2025</td><td>Feb 14, 2025</td><td><span class="badge badge-gray">Deactivated</span></td><td><div style="display:flex;gap:5px"><button class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></button><button class="btn btn-secondary btn-sm"><i class="fas fa-check"></i> Reactivate</button><button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></div></td></tr>
        </tbody>
      </table></div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════
     MODALS
════════════════════════════════════ -->
<!-- Add Donor Modal -->
<div class="modal-overlay" id="addDonorModal">
  <div class="modal">
    <div class="modal-head"><h2><i class="fas fa-user-plus"></i> Add new donor</h2><button class="modal-close" onclick="closeModal('addDonorModal')"><i class="fas fa-times"></i></button></div>
    <div class="form-grid form-grid-2">
      <div class="field"><label>First name</label><input type="text" placeholder="e.g. Maria"></div>
      <div class="field"><label>Last name</label><input type="text" placeholder="e.g. Santos"></div>
      <div class="field"><label>Email</label><input type="email" placeholder="email@example.com"></div>
      <div class="field"><label>Contact number</label><input type="tel" placeholder="09XX XXX XXXX"></div>
      <div class="field"><label>Date of birth</label><input type="date"></div>
      <div class="field"><label>Blood type</label><select><option value="">Select type</option><option>A+</option><option>A−</option><option>B+</option><option>B−</option><option>AB+</option><option>AB−</option><option>O+</option><option>O−</option></select></div>
      <div class="field"><label>Sex</label><select><option>Male</option><option>Female</option></select></div>
      <div class="field"><label>Status</label><select><option>Eligible</option><option>Deferred</option><option>Inactive</option></select></div>
      <div class="field" style="grid-column:span 2"><label>Address</label><input type="text" placeholder="Complete address"></div>
    </div>
    <div class="modal-foot"><button class="btn btn-outline" onclick="closeModal('addDonorModal')">Cancel</button><button class="btn btn-primary" onclick="closeModal('addDonorModal');showToast('Donor added successfully!',true)"><i class="fas fa-save"></i> Save donor</button></div>
  </div>
</div>

<!-- Add Inventory Modal -->
<div class="modal-overlay" id="addInvModal">
  <div class="modal">
    <div class="modal-head"><h2><i class="fas fa-tint"></i> Add blood units</h2><button class="modal-close" onclick="closeModal('addInvModal')"><i class="fas fa-times"></i></button></div>
    <div class="form-grid form-grid-2">
      <div class="field"><label>Blood type</label><select><option value="">Select type</option><option>A+</option><option>A−</option><option>B+</option><option>B−</option><option>AB+</option><option>AB−</option><option>O+</option><option>O−</option></select></div>
      <div class="field"><label>Number of units</label><input type="number" min="1" placeholder="e.g. 50"></div>
      <div class="field"><label>Collection date</label><input type="date"></div>
      <div class="field"><label>Expiry date <span style="color:var(--ink-4);font-weight:400">(auto: +42 days)</span></label><input type="date"></div>
      <div class="field"><label>Source / Donor ID</label><input type="text" placeholder="e.g. DNR-0001"></div>
      <div class="field"><label>Storage location</label><input type="text" placeholder="e.g. Refrigerator A-2"></div>
      <div class="field" style="grid-column:span 2"><label>Notes</label><textarea rows="2" placeholder="Additional notes…" style="resize:vertical;width:100%"></textarea></div>
    </div>
    <div class="modal-foot"><button class="btn btn-outline" onclick="closeModal('addInvModal')">Cancel</button><button class="btn btn-primary" onclick="closeModal('addInvModal');showToast('Blood units added!',true)"><i class="fas fa-save"></i> Save units</button></div>
  </div>
</div>

<!-- New Request Modal -->
<div class="modal-overlay" id="newReqModal">
  <div class="modal">
    <div class="modal-head"><h2><i class="fas fa-file-medical"></i> New blood request</h2><button class="modal-close" onclick="closeModal('newReqModal')"><i class="fas fa-times"></i></button></div>
    <div class="form-grid form-grid-2">
      <div class="field"><label>Requesting ward</label><input type="text" placeholder="e.g. Emergency Ward"></div>
      <div class="field"><label>Requested by</label><input type="text" placeholder="Doctor / Staff name"></div>
      <div class="field"><label>Blood type needed</label><select><option value="">Select type</option><option>A+</option><option>A−</option><option>B+</option><option>B−</option><option>AB+</option><option>AB−</option><option>O+</option><option>O−</option></select></div>
      <div class="field"><label>Units needed</label><input type="number" min="1" placeholder="e.g. 2"></div>
      <div class="field"><label>Priority</label><select><option>Normal</option><option>High</option><option>Urgent</option></select></div>
      <div class="field"><label>Date needed</label><input type="date"></div>
      <div class="field" style="grid-column:span 2"><label>Notes / Reason</label><textarea rows="2" placeholder="Patient condition…" style="resize:vertical;width:100%"></textarea></div>
    </div>
    <div class="modal-foot"><button class="btn btn-outline" onclick="closeModal('newReqModal')">Cancel</button><button class="btn btn-primary" onclick="closeModal('newReqModal');showToast('Request submitted!',true)"><i class="fas fa-paper-plane"></i> Submit request</button></div>
  </div>
</div>

<!-- Add Screening Modal -->
<div class="modal-overlay" id="addScreenModal">
  <div class="modal">
    <div class="modal-head"><h2><i class="fas fa-vial"></i> Add screening record</h2><button class="modal-close" onclick="closeModal('addScreenModal')"><i class="fas fa-times"></i></button></div>
    <div class="form-grid form-grid-2">
      <div class="field"><label>Donor ID</label><input type="text" placeholder="e.g. DNR-0001"></div>
      <div class="field"><label>Screening date</label><input type="date"></div>
      <div class="field"><label>Hemoglobin (g/dL)</label><input type="number" step="0.1" placeholder="e.g. 13.5"></div>
      <div class="field"><label>Blood pressure</label><input type="text" placeholder="e.g. 120/80"></div>
      <div class="field"><label>Weight (kg)</label><input type="number" step="0.1" placeholder="e.g. 60"></div>
      <div class="field"><label>Pulse rate</label><input type="number" placeholder="e.g. 72"></div>
      <div class="field"><label>HIV test result</label><select><option>Non-reactive</option><option>Reactive</option><option>Indeterminate</option></select></div>
      <div class="field"><label>Hepatitis test result</label><select><option>Non-reactive</option><option>Reactive</option><option>Indeterminate</option></select></div>
      <div class="field"><label>Screening result</label><select><option>Passed</option><option>Failed</option><option>Pending</option></select></div>
      <div class="field"><label>Screened by</label><select><option>Ana Reyes</option><option>Pedro Bautista</option><option>Juan Dela Cruz</option></select></div>
      <div class="field" style="grid-column:span 2"><label>Notes</label><textarea rows="2" placeholder="Additional observations…" style="resize:vertical;width:100%"></textarea></div>
    </div>
    <div class="modal-foot"><button class="btn btn-outline" onclick="closeModal('addScreenModal')">Cancel</button><button class="btn btn-primary" onclick="closeModal('addScreenModal');showToast('Screening record saved!',true)"><i class="fas fa-save"></i> Save record</button></div>
  </div>
</div>

<!-- Log Release Modal -->
<div class="modal-overlay" id="addReleaseModal">
  <div class="modal">
    <div class="modal-head"><h2><i class="fas fa-box-open"></i> Log blood release</h2><button class="modal-close" onclick="closeModal('addReleaseModal')"><i class="fas fa-times"></i></button></div>
    <div class="form-grid form-grid-2">
      <div class="field"><label>Request reference</label><input type="text" placeholder="e.g. REQ-0042"></div>
      <div class="field"><label>Ward / Recipient</label><input type="text" placeholder="e.g. Emergency Ward"></div>
      <div class="field"><label>Blood type</label><select><option value="">Select type</option><option>A+</option><option>A−</option><option>B+</option><option>B−</option><option>AB+</option><option>AB−</option><option>O+</option><option>O−</option></select></div>
      <div class="field"><label>Units released</label><input type="number" min="1" placeholder="e.g. 2"></div>
      <div class="field"><label>Batch ID</label><input type="text" placeholder="e.g. BTH-0001"></div>
      <div class="field"><label>Release date</label><input type="date"></div>
      <div class="field"><label>Received by (ward)</label><input type="text" placeholder="Doctor / Nurse name"></div>
      <div class="field"><label>Released by</label><select><option>Juan Dela Cruz</option><option>Ana Reyes</option></select></div>
    </div>
    <div class="modal-foot"><button class="btn btn-outline" onclick="closeModal('addReleaseModal')">Cancel</button><button class="btn btn-primary" onclick="closeModal('addReleaseModal');showToast('Release logged!',true)"><i class="fas fa-save"></i> Save release</button></div>
  </div>
</div>

<!-- Add Staff Modal -->
<div class="modal-overlay" id="addStaffModal">
  <div class="modal">
    <div class="modal-head"><h2><i class="fas fa-user-plus"></i> Add staff member</h2><button class="modal-close" onclick="closeModal('addStaffModal')"><i class="fas fa-times"></i></button></div>
    <div class="form-grid form-grid-2">
      <div class="field"><label>Full name</label><input type="text" placeholder="e.g. Juan Dela Cruz"></div>
      <div class="field"><label>Email</label><input type="email" placeholder="staff@pagamutandasma.gov.ph"></div>
      <div class="field"><label>Contact number</label><input type="tel" placeholder="09XX XXX XXXX"></div>
      <div class="field"><label>Role</label><select><option>Staff</option><option>Admin</option></select></div>
      <div class="field"><label>Department</label><select><option>Blood Bank Staff</option><option>Laboratory Technician</option><option>Nurse</option><option>Medical Technologist</option><option>Administrative Staff</option></select></div>
      <div class="field"><label>Password</label><input type="password" placeholder="Temporary password"></div>
      <div class="field" style="grid-column:span 2"><label>Confirm password</label><input type="password" placeholder="Re-enter password"></div>
    </div>
    <div class="modal-foot"><button class="btn btn-outline" onclick="closeModal('addStaffModal')">Cancel</button><button class="btn btn-primary" onclick="closeModal('addStaffModal');showToast('Staff account created!',true)"><i class="fas fa-save"></i> Create account</button></div>
  </div>
</div>

<!-- Toast -->
<div class="toast" id="toast"><i class="fas fa-check-circle t-ok" id="toastIcon"></i><span id="toastMsg">Done.</span></div>

<script>
// ── PAGE SWITCHER ──
function showPage(page) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.demo-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('page-' + page).classList.add('active');
  const btn = document.querySelector(`.demo-btn[onclick="showPage('${page}')"]`);
  if (btn) btn.classList.add('active');

  // Init charts when showing report or dashboard
  if (page === 'dashboard') initDashCharts();
  if (page === 'reports') initReportCharts();
}

// ── MODAL ──
function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(el => {
  el.addEventListener('click', e => { if (e.target === el) el.classList.remove('open'); });
});

// ── TOAST ──
function showToast(msg, ok = true) {
  document.getElementById('toastMsg').textContent = msg;
  document.getElementById('toastIcon').className = ok ? 'fas fa-check-circle t-ok' : 'fas fa-times-circle t-err';
  const t = document.getElementById('toast');
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3200);
}

// ── TOGGLE PASSWORD ──
function togglePw(inputId, iconId) {
  const inp = document.getElementById(inputId);
  const ico = document.getElementById(iconId);
  const show = inp.type === 'password';
  inp.type = show ? 'text' : 'password';
  ico.className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
}

// ── SIGNUP STEPS ──
let regStep_n = 1;
function regStep(n) {
  document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
  document.getElementById('sec' + n).classList.add('active');
  for (let i = 1; i <= 3; i++) {
    const el = document.getElementById('rs' + i);
    const circle = el.querySelector('.rs-circle');
    if (i < n) { el.className = 'rs done'; circle.innerHTML = '<i class="fas fa-check" style="font-size:9px"></i>'; }
    else if (i === n) { el.className = 'rs active'; circle.textContent = i; }
    else { el.className = 'rs idle'; circle.textContent = i; }
  }
  // Build review on step 3
  if (n === 3) {
    document.getElementById('reviewContent').innerHTML =
      '<div><b>Name:</b> ' + (document.getElementById('regFirst').value || 'Maria') + ' ' + (document.getElementById('regLast').value || 'Santos') + '</div>' +
      '<div><b>Email:</b> ' + (document.getElementById('regEmail').value || 'maria@email.com') + '</div>' +
      '<div><b>Role:</b> Staff (pending approval)</div>';
  }
  regStep_n = n;
}
function submitReg() {
  document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
  document.getElementById('regSteps').style.display = 'none';
  document.getElementById('regSuccess').style.display = 'block';
}

// ── PASSWORD STRENGTH ──
function checkPwStr(val) {
  let s = 0;
  if (val.length >= 8) s++;
  if (/[A-Z]/.test(val)) s++;
  if (/[0-9]/.test(val)) s++;
  if (/[^A-Za-z0-9]/.test(val)) s++;
  const bar = document.getElementById('pwBar');
  const lbl = document.getElementById('pwLabel');
  const m = [{w:'0%',c:'var(--line)',t:'Enter a password'},{w:'25%',c:'var(--red)',t:'Weak'},{w:'50%',c:'var(--yellow-dark)',t:'Fair'},{w:'75%',c:'var(--yellow-dark)',t:'Good'},{w:'100%',c:'var(--green)',t:'Strong ✓'}];
  bar.style.width = m[s].w; bar.style.background = m[s].c;
  lbl.textContent = m[s].t; lbl.style.color = m[s].c;
}
document.getElementById('regPwC').addEventListener('input', function() {
  const match = this.value === document.getElementById('regPw').value;
  const hint = document.getElementById('matchHint');
  hint.textContent = this.value === '' ? 'Must match password above' : match ? '✓ Passwords match.' : '⚠ Passwords do not match.';
  hint.style.color = this.value === '' ? 'var(--ink-4)' : match ? 'var(--green)' : 'var(--red)';
});

// ── CHARTS ──
Chart.defaults.font.family = "'Outfit', sans-serif";
Chart.defaults.font.size   = 11;
Chart.defaults.color       = '#6B7280';

let dashChartsDone = false;
function initDashCharts() {
  if (dashChartsDone) return;
  dashChartsDone = true;
  setTimeout(() => {
    new Chart(document.getElementById('trendChart'), {
      type: 'bar',
      data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
          data: [540,585,617,0,0,0,0,0,0,0,0,0],
          backgroundColor: 'rgba(31,122,31,0.15)',
          borderColor: '#1F7A1F',
          borderWidth: 2,
          borderRadius: 5,
          borderSkipped: false,
        },{
          type: 'line',
          data: [600,600,600,600,600,600,600,600,600,600,600,600],
          borderColor: '#FFD700',
          borderWidth: 1.5,
          borderDash: [4,4],
          pointRadius: 0,
          fill: false,
        }]
      },
      options: {
        responsive:true, maintainAspectRatio:false,
        plugins:{legend:{display:false},tooltip:{mode:'index',intersect:false}},
        scales:{x:{grid:{display:false},border:{display:false}},y:{grid:{color:'#F3F4F6'},border:{display:false},beginAtZero:true}}
      }
    });
    setTimeout(() => { document.getElementById('goalBar').style.width = '88%'; }, 300);
  }, 100);
}

let reportChartsDone = false;
function initReportCharts() {
  if (reportChartsDone) return;
  reportChartsDone = true;
  setTimeout(() => {
    new Chart(document.getElementById('reportChart'), {
      type: 'bar',
      data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
          data: [540,585,617,0,0,0,0,0,0,0,0,0],
          backgroundColor: 'rgba(31,122,31,0.2)',
          borderColor: '#1F7A1F',
          borderWidth: 2,
          borderRadius: 6,
        },{
          type: 'line',
          data: [600,600,600,600,600,600,600,600,600,600,600,600],
          borderColor: '#FFD700',
          borderWidth: 2,
          borderDash: [5,4],
          pointRadius: 0,
          fill: false,
        }]
      },
      options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{grid:{display:false},border:{display:false}},y:{grid:{color:'#F3F4F6'},border:{display:false},beginAtZero:true}}}
    });
    new Chart(document.getElementById('donutChart'), {
      type: 'doughnut',
      data: {
        labels: ['A+','A−','B+','B−','AB+','AB−','O+','O−'],
        datasets: [{
          data: [210,45,180,30,95,20,520,150],
          backgroundColor: ['#1F7A1F','#7ED957','#2563EB','#DC2626','#7C3AED','#EA580C','#1F7A1F','#155215'],
          borderWidth: 2,
          borderColor: '#fff',
          hoverOffset: 8,
        }]
      },
      options:{responsive:true,maintainAspectRatio:false,cutout:'60%',plugins:{legend:{display:true,position:'right',labels:{boxWidth:12,padding:12,font:{size:12}}}}}
    });
  }, 100);
}

// Init dashboard on load
initDashCharts();
</script>
</body>
</html>