# 🚀 راهنمای پیاده‌سازی طراحی جدید در المنتور (Elementor + Astra)

این راهنما به شما کمک می‌کند طراحی جدید صفحه «طراحی سایت» را روی وردپرس + قالب Astra + المنتور (Free یا Pro) پیاده‌سازی کنید.

---

## 📌 پیش‌نیازها

- وردپرس نسخه ۶.۴ یا بالاتر
- قالب **Astra** (نسخه رایگان کافی است)
- افزونه **Elementor** (Free یا Pro — بخش‌هایی مثل Custom CSS فقط در Pro هستند، ولی جایگزین ارائه شده)
- افزونه پیشنهادی: **Happy Addons** یا **Essential Addons** (برای Bento Grid آسان‌تر)
- فونت **وزیرمتن** (Vazirmatn) — یا از تنظیمات Astra Customizer یا با افزونه فونت ایران

---

## 🎨 گام ۱: تنظیم رنگ‌ها و فونت‌های Global در المنتور

### مسیر:
**Elementor → Site Settings → Global Colors**

| نام رنگ | کد HEX | کاربرد |
|---|---|---|
| Primary | `#6C5CE7` | دکمه‌ها، لینک‌ها، تأکیدها |
| Secondary | `#00D9C0` | عناصر تأکیدی، آیکون‌ها |
| Text | `#0F172A` | متن اصلی |
| Accent | `#FF6B9D` | هایلایت‌های ویژه |

### Global Fonts:
**Elementor → Site Settings → Global Fonts**

| نام | فونت | وزن | اندازه |
|---|---|---|---|
| Primary (هدینگ‌ها) | Vazirmatn | 800 | 60px |
| Secondary (متن) | Vazirmatn | 500 | 18px |
| Text | Vazirmatn | 400 | 16px |

---

## 🏗️ گام ۲: ساختار کلی صفحه

این صفحه از **۹ سکشن** تشکیل شده است. هر سکشن را به ترتیب در یک Section جداگانه در المنتور بسازید.

### قالب Page Layout:
- در تنظیمات صفحه (پایین کادر ویرایش): **Elementor Full Width** را انتخاب کنید
- Padding صفحه: ۰
- Hide Title: روشن

---

## 📦 سکشن‌ها به ترتیب

### ۱️⃣ Hero Section (بنر اصلی)

**ساختار:** Section با ۲ ستون

**ستون راست (محتوا):**
- Widget: **Heading** → برای eyebrow بالای تیتر
- Widget: **Heading** (H1) → تیتر اصلی
  - متن: `ساخت سایتی که می‌فروشد، نه فقط دیده می‌شود.`
  - برای کلمه «می‌فروشد» از تگ `<span class="grad-text">می‌فروشد</span>` استفاده کنید
- Widget: **Text Editor** → متن توضیحی
- Widget: **Button** ×۲ → دکمه‌های CTA
- Widget: **Icon List** یا ۴ تا Counter → آمار (۴۵۰+ پروژه و...)

**ستون چپ (تصویر):**
- بهترین گزینه: یک تصویر mockup سایت در Photoshop/Figma طراحی کنید
- یا از Widget **Image** با تصویر آماده استفاده کنید
- اضافه کنید ۳ کارت شناور (Floating Cards) با Widget **Icon Box** و Position: Absolute

**Background سکشن:**
```
نوع: Gradient
رنگ ۱: rgba(108, 92, 231, 0.18) at 80% 0%
رنگ ۲: rgba(0, 217, 192, 0.18) at 10% 100%
نوع: Radial
```

---

### ۲️⃣ Trust Strip (نوار اعتماد)

- Section با Background: `#F8FAFC`
- Padding: 48px بالا و پایین
- ۱ Heading کوچک + Inner Section با ۶ ستون شامل لوگوی مشتریان (Widget: Image)

---

### ۳️⃣ Features Bento Grid (ویژگی‌ها)

**ساختار:** Section عنوان + Bento Grid

**روش پیاده‌سازی Bento Grid در Elementor:**

#### روش A (Free — توصیه می‌شود):
- Section با ۲ Inner Section پشت سر هم
- Inner Section ۱: ۲ ستون (50% / 50%)
- Inner Section ۲: ۳ ستون (33% / 33% / 33%)
- در هر ستون یک Widget **Icon Box** با تنظیمات:
  - Background: `#FFFFFF`
  - Border: `1px solid #E2E8F0`
  - Border Radius: `28px`
  - Padding: `28px`
  - Hover: `box-shadow: 0 12px 32px rgba(15,23,42,.10); transform: translateY(-4px);`

#### روش B (Pro):
- استفاده از Widget **Loop Grid** با CPT برای Features
- یا CSS Grid از طریق Custom CSS

**کارت ویژه (تیره):**
یکی از کارت‌ها را با Background تیره `#0F172A` و متن سفید بسازید.

---

### ۴️⃣ Process Section (فرآیند ۴ گام)

- Section با Background: `#F8FAFC`
- ۱ Heading + Subtitle
- Inner Section با ۴ ستون مساوی
- در هر ستون Widget **Icon Box**:
  - شماره گام را به‌جای آیکون، در یک Heading با Background گرادیان قرار دهید
  - Position: Absolute برای شماره
  - Border Radius کارت: `28px`

**نکته:** برای خط نقطه‌چین بین گام‌ها، از Custom CSS استفاده کنید (در فایل CSS موجود است).

---

### ۵️⃣ Pricing Section (پکیج‌ها)

**ساختار:** ۳ ستون

برای هر پلن:
- Widget: **Price Table** (موجود در المنتور Pro) یا **Price List** (Free)
- یا یک Inner Section حاوی:
  - Heading (نام پکیج)
  - Heading بزرگ (قیمت)
  - Text (توضیح)
  - Icon List (ویژگی‌ها) — آیکون: `check-circle` با رنگ `#00D9C0`
  - Button (انتخاب)

**پلن وسط (Featured):**
- Background: Gradient `#1A1340 → #2A1F6B` (135deg)
- متن سفید
- یک Badge «پرطرفدار» با Position: Absolute در گوشه

---

### ۶️⃣ Testimonials Section (نظرات)

- Background: `#F8FAFC`
- ۳ ستون
- در هر ستون Widget **Testimonial** یا **Review** یا یک Inner Section حاوی:
  - ⭐⭐⭐⭐⭐ (Heading)
  - متن نظر
  - آواتار + نام + سمت

---

### ۷️⃣ FAQ Section (سوالات متداول)

- Widget: **Accordion** یا **Toggle** المنتور
- تنظیمات:
  - Border Radius: `18px`
  - Padding هر آیتم: `22px 26px`
  - فعال: Border رنگ `#6C5CE7`
  - Icon: `+` که در حالت باز ۴۵ درجه می‌چرخد

اگر می‌خواهید دقیقاً مثل طراحی، از **Happy Addons → Advanced Accordion** یا **Element Pack → Modern Accordion** استفاده کنید.

---

### ۸️⃣ CTA Section (دعوت به اقدام)

- Inner Section با Background Gradient:
  - `linear-gradient(135deg, #1A1340 0%, #3B2A8C 50%, #0E7C7B 100%)`
- Border Radius: `28px`
- Padding: `64px 48px`
- ۱ Heading + Text + ۲ Button
- Background Overlay: گرادیان شعاعی برای افکت نور (با CSS سفارشی)

---

### ۹️⃣ Footer

- Section ساده با Background: `#0F172A`
- متن کپی‌رایت

---

## 🛠️ گام ۳: اضافه کردن Custom CSS

فایل `astra-custom-css.css` را باز کنید و کل محتوا را در یکی از این مکان‌ها قرار دهید:

### گزینه ۱ (توصیه می‌شود):
**Appearance → Customize → Additional CSS**

### گزینه ۲ (در صورت داشتن المنتور Pro):
**Elementor → Custom CSS** هر سکشن

### گزینه ۳:
استفاده از افزونه **Simple Custom CSS and JS** و paste کل کد در یک snippet

---

## 🎯 گام ۴: نکات کلیدی برای حفظ سئو

⚠️ **مهم:** برای حفظ رتبه گوگل، این موارد را رعایت کنید:

1. **URL را تغییر ندهید**: همان `/website-design/` باقی بماند
2. **تگ‌های هدینگ:** فقط ۱ عدد H1 در صفحه (در Hero) — بقیه H2/H3
3. **متا تایتل و Description:** از Yoast SEO یا RankMath همان‌های قبلی را نگه دارید
4. **Alt تصاویر:** همه تصاویر را Alt مناسب با کلمه «طراحی سایت» بدهید
5. **اسکیما:** اگر در طراحی قبلی Schema Service یا FAQ داشتید، حتماً منتقل کنید
6. **Internal Links:** لینک‌های داخلی به سایر صفحات سرویس را در محتوا بگنجانید

---

## 🚀 گام ۵: تست و انتشار

1. **پیش‌نمایش:** قبل از انتشار، در Preview حالت موبایل، تبلت و دسکتاپ را چک کنید
2. **سرعت:** پس از انتشار با [PageSpeed Insights](https://pagespeed.web.dev) تست کنید
3. **Mobile-Friendly Test:** [search.google.com/test/mobile-friendly](https://search.google.com/test/mobile-friendly)
4. **Submit به سرچ کنسول:** صفحه را Re-index کنید

---

## 💡 پیشنهاد: استفاده از Template Kit

اگر نمی‌خواهید سکشن به سکشن بسازید:
1. فایل `website-design-redesign.html` را روی یک هاست تستی آپلود کنید
2. هر سکشن را به‌صورت جداگانه در المنتور دوباره بسازید
3. سپس آن را به‌عنوان **Template** ذخیره کنید (Elementor → Templates → Save as Template)

---

## 📞 سوالی دارید؟

اگر در پیاده‌سازی هر بخش به مشکل خوردید، بفرستید تا با هم حل کنیم. می‌توانم برای هر سکشن، JSON المنتور هم بسازم اگر بخواهید.
