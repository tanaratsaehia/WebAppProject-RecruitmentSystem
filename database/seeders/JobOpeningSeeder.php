<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobOpening;

class JobOpeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobOpening::create([
            'job_title' => 'Senior Backend Java Developer',
            'description' => 'เรากำลังมองหา Senior Backend Java Developer มาร่วมทีม พร้อมเริ่มงานเลยพิจารณาเป็นพิเศษ',
            'skill_required' => 'ประสบการณ์ 3 ปีขึ้นไป ในสาย Banking / Java Software Development\nเชี่ยวชาญ Spring Boot หรือ Spring MVC\nมีประสบการณ์ Web Service Development (J2EE Framework) เช่น Servlet, Java Beans, EJB, JMS, JavaMail, HTML, XML, UML\nมีประสบการณ์การใช้งาน ฐานข้อมูลระดับองค์กร (เช่น Oracle, MSSQL) รวมถึง IDE อย่าง Eclipse, NetBeans หรือ JetBrains และระบบควบคุมเวอร์ชัน Git \n ความรู้เชิงลึกด้าน OOP, REST และ SOAP Web Services \n หากคุ้นเคยกับ Agile/Scrum จะได้รับการพิจารณาเป็นพิเศษ'
        ]);

        JobOpening::create([
            'job_title' => 'Senior Backend Java Developer 2',
            'description' => 'เรากำลังมองหา Senior Backend Java Developer มาร่วมทีม พร้อมเริ่มงานเลยพิจารณาเป็นพิเศษ 2',
            'skill_required' => 'ประสบการณ์ 3 ปีขึ้นไป ในสาย Banking / Java Software Development \n เชี่ยวชาญ Spring Boot หรือ Spring MVC \n มีประสบการณ์ Web Service Development (J2EE Framework) เช่น Servlet, Java Beans, EJB, JMS, JavaMail, HTML, XML, UML \n มีประสบการณ์การใช้งาน ฐานข้อมูลระดับองค์กร (เช่น Oracle, MSSQL) รวมถึง IDE อย่าง Eclipse, NetBeans หรือ JetBrains และระบบควบคุมเวอร์ชัน Git \n ความรู้เชิงลึกด้าน OOP, REST และ SOAP Web Services \n หากคุ้นเคยกับ Agile/Scrum จะได้รับการพิจารณาเป็นพิเศษ'
        ]);
    }
}
