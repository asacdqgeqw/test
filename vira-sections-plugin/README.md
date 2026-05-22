# 🚀 Vira Sections — Elementor Widget Plugin

افزونه المنتور با **۹ ویجت تعاملی و حرفه‌ای** برای ساخت لندینگ‌پیج فارسی RTL.

تمام سکشن‌هایی که برای صفحات سایت ویرا سئو ساختیم، حالا به صورت ویجت‌های قابل ویرایش در المنتور در دسترس هستند.

---

## 📦 ویجت‌های موجود

1. **Hero (Vira)** — بنر اصلی با Aurora گرادیان متحرک، Tilt 3D، کلمات چرخان و شمارنده انیمیشنی
2. **Services Bento (Vira)** — گرید Bento انعطاف‌پذیر با سایزهای متغیر
3. **Interactive Tabs (Vira)** — تب‌های تعاملی با پنل گرادیانی و KPIها
4. **Process Timeline (Vira)** — تایم‌لاین کلیک‌شونده با پنل جزئیات
5. **Tech Stack (Vira)** — نمایش تکنولوژی با تب، کد و گرید لوگوها
6. **Pricing (Vira)** — کارت‌های قیمت با Toggle ماهانه/سالانه
7. **Testimonials Slider (Vira)** — اسلایدر ۳بعدی نظرات با metric badge
8. **FAQ Search (Vira)** — سوالات متداول با جستجو و فیلتر دسته‌بندی
9. **CTA Form (Vira)** — فرم دعوت به اقدام با glass-morphism

---

## ✨ ویژگی‌ها

- ✅ **همه چیز قابل ویرایش**: متن، رنگ، گرادیان، اندازه، آیکن
- ✅ **پشتیبانی از تصاویر سفارشی** (Hero، Testimonials، Tech Stack Logos)
- ✅ **RTL کامل** برای فارسی
- ✅ **ریسپانسیو** روی موبایل، تبلت، دسکتاپ
- ✅ **استایل ایزوله**: هر ویجت ID اختصاصی دارد و با هم تداخل ندارند
- ✅ **عملکرد بالا**: استایل و JS اینلاین، بدون وابستگی خارجی
- ✅ **سازگار با هر قالب**: Astra، Hello، GeneratePress و…
- ✅ **سازگار با المنتور Free و Pro**

---

## 🚀 نصب سریع

1. کل پوشه `vira-sections-plugin` را به ZIP تبدیل کن
2. در وردپرس → **افزونه‌ها → افزودن → بارگذاری** کن
3. فعال کن
4. در ویرایشگر المنتور دنبال **`vira`** بگرد

برای راهنمای کامل: [`docs/INSTALLATION.md`](docs/INSTALLATION.md)

---

## 📁 ساختار پروژه

```
vira-sections-plugin/
├── vira-sections.php           ← فایل اصلی پلاگین
├── readme.txt                  ← اطلاعات استاندارد وردپرس
├── uninstall.php               ← پاکسازی هنگام حذف
├── widgets/                    ← ۹ کلاس ویجت
│   ├── class-hero.php
│   ├── class-services-bento.php
│   ├── class-tabs.php
│   ├── class-process-timeline.php
│   ├── class-tech-stack.php
│   ├── class-pricing.php
│   ├── class-testimonials-slider.php
│   ├── class-faq-search.php
│   └── class-cta-form.php
├── assets/
│   └── css/
│       ├── frontend.css        ← استایل‌های مشترک
│       └── editor.css          ← استایل پنل المنتور
├── docs/
│   └── INSTALLATION.md         ← راهنمای فارسی
└── includes/                   ← فایل‌های مشترک آینده
```

---

## 🎨 پالت رنگ‌های پیش‌فرض

| نقش | کد | کاربرد |
|---|---|---|
| Primary | `#170C79` | تیترها، گرادیان اصلی |
| Secondary | `#0170B9` | رنگ تأکیدی |
| Accent | `#128BE0` | لینک‌ها، دکمه‌ها |
| Cyan | `#8ACBD0` | افکت‌ها، گرادیان نرم |
| Cream | `#EFE3CA` | پس‌زمینه گرم |
| Ink | `#1D2327` | متن اصلی |

می‌تونی برای هر صفحه رنگ متفاوت تنظیم کنی!

---

## 🔧 توسعه‌دهنده‌ها

```bash
# Lint PHP
find vira-sections-plugin -name "*.php" -exec php -l {} \;

# همه فایل‌ها بدون خطای syntax هستند
```

---

## 📞 پشتیبانی

اگر سوال یا باگی داری، در [GitHub Issues](https://github.com/asacdqgeqw/test/issues) مطرح کن.

---

## 📜 لایسنس

GPL v2 or later
