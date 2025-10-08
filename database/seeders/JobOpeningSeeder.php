<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobOpening;

class JobOpeningSeeder extends Seeder
{
    public function run(): void
    {
        JobOpening::create([
            'job_title' => 'Senior Backend Java Developer',
            'description' => 'เรากำลังมองหา Senior Backend Java Developer มาร่วมทีม พร้อมเริ่มงานเลยพิจารณาเป็นพิเศษ',
            'skill_required' => 'ประสบการณ์ 3 ปีขึ้นไป ในสาย Banking / Java Software Development\nเชี่ยวชาญ Spring Boot หรือ Spring MVC\nมีประสบการณ์ Web Service Development (J2EE Framework) เช่น Servlet, Java Beans, EJB, JMS, JavaMail, HTML, XML, UML\nมีประสบการณ์การใช้งาน ฐานข้อมูลระดับองค์กร (เช่น Oracle, MSSQL) รวมถึง IDE อย่าง Eclipse, NetBeans หรือ JetBrains และระบบควบคุมเวอร์ชัน Git\nความรู้เชิงลึกด้าน OOP, REST และ SOAP Web Services\nหากคุ้นเคยกับ Agile/Scrum จะได้รับการพิจารณาเป็นพิเศษ'
        ]);
        JobOpening::create([
            'job_title' => 'Mid-Level Frontend React Developer',
            'description' => 'มองหาผู้เชี่ยวชาญด้าน React และ TypeScript เพื่อสร้าง User Interface ที่ตอบสนองและปรับขนาดได้',
            'skill_required' => 'ประสบการณ์ 2 ปีขึ้นไปในการพัฒนาเว็บฟรอนต์เอนด์\nเชี่ยวชาญ React.js, Redux/Zustand, และ TypeScript\nสามารถใช้ Tailwind CSS หรือ Bootstrap เพื่อออกแบบหน้าจอ\nมีความเข้าใจในการใช้ RESTful API\nใช้งานระบบควบคุมเวอร์ชัน Git ได้เป็นอย่างดี'
        ]);
        JobOpening::create([
            'job_title' => 'Cloud DevOps Engineer',
            'description' => 'วิศวกร DevOps ที่มีประสบการณ์ด้าน Cloud (AWS/GCP) และ CI/CD เพื่อดูแลและปรับปรุงโครงสร้างพื้นฐาน',
            'skill_required' => 'ประสบการณ์ 3 ปีในการดูแลระบบ Cloud (AWS หรือ GCP)\nมีความเชี่ยวชาญใน Docker และ Kubernetes\nมีประสบการณ์ในการใช้งาน Jenkins/GitLab CI/CD\nมีความรู้ในการจัดการ Infrastructure as Code (เช่น Terraform หรือ Ansible)\nมีทักษะในการเขียน Shell Script หรือ Python สำหรับงาน Automation'
        ]);
        JobOpening::create([
            'job_title' => 'Junior Data Scientist',
            'description' => 'รับนักวิทยาศาสตร์ข้อมูลรุ่นใหม่ไฟแรง เพื่อวิเคราะห์ข้อมูลและพัฒนาโมเดลคาดการณ์เชิงธุรกิจ',
            'skill_required' => 'จบการศึกษาระดับปริญญาโทด้านสถิติ/วิทยาการคอมพิวเตอร์ หรือสาขาที่เกี่ยวข้อง\nมีความเชี่ยวชาญใน Python Libraries (Pandas, NumPy, Scikit-learn, TensorFlow)\nมีประสบการณ์ในการสร้างและปรับใช้ Machine Learning Model\nสามารถใช้ SQL และ Visualization Tools (เช่น Tableau หรือ Power BI) ได้'
        ]);
        JobOpening::create([
            'job_title' => 'Full Stack PHP/Laravel Developer',
            'description' => 'รับนักพัฒนา Full Stack ที่เชี่ยวชาญ Laravel เพื่อดูแลทั้งระบบ Back-end และ Front-end',
            'skill_required' => 'ประสบการณ์ 4 ปีขึ้นไปในการพัฒนา PHP/Laravel\nมีทักษะใน JavaScript Frameworks (Vue.js หรือ React)\nเชี่ยวชาญในการจัดการฐานข้อมูล MySQL\nมีความเข้าใจใน API Development (RESTful)\nมีประสบการณ์ในการดูแลเซิร์ฟเวอร์ (เช่น Nginx/Apache) จะได้รับการพิจารณาเป็นพิเศษ'
        ]);
    }
}