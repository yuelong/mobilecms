/*******************
 * 开发说明
 ******************/
/**
 * 功能名称或简介
**/

函数注释规则:
/**
 * 激活数据库对象
 *
 * @param  integer $var1 变量一
 * @param  string  $var1 变量二
 * @param  boolean $var1 变量三
 * @return string
**/

1.文件组织结构:
Fend
│  Default.Config.php: 类库配置文件
│  Exception.php: 异常抛出对象
│  Fend.php: 类库入口对象,使用Fend开发包必须先加载该文件
│  Fix.php: 文件加载器(载入/引入文件),通常用于替代INCLUDE,require
│  Func.php: 函数加载器,用于载入函数文件
│  Loader.php: 引导文件,用于URL重写后定位模块
│  Cache.php: 缓存处理模块
│  Session.php: Session对象
│  Readme.txt: 开发说明
│
├─ Check
│  │  Code.php
│  ├─C# :C#环境下的API
│  │      Example.cs: 示例程序
│  │      ICTCLAS30.dll：ICTCLAS3.0动态链接库
│  │      ICTCLAS30.h: ICTCLAS3.0头文件
│  │      ICTCLAS30.lib: ICTCLAS3.0 Library
│  │      ICTCLAS_C#_Demo.exe：示例程序生成的可执行文件
│  ├─JNI :Java下采用的API (Javac TestICTCLAS30.java编译；Java TestICTCLAS30)
│  │      ICTCLAS30.dll: ICTCLAS3.0动态链接库
│  │      TestICTCLAS30.java: 示例程序
│  │      TestICTCLAS30.class: Java编译之后产生的class文件
│  │      Test.txt: 测试源文件
│  │      Test_result.txt：测试源文件生成的结果文件
│  ├─Linux_C :Linux下采用C的API
│  │      Example.cpp: 示例程序
│  │      ICTCLAS30.h: ICTCLAS3.0头文件
│  │      libICTCLAS30.a: ICTCLAS3.0 Library
│  │      Makefile：示例程序编译用的Makefile文件
│  │      test：示例程序生成的可执行文件
│  ├─Linux_JNI :Linux下Java采用的API
│  │      TestICTCLAS30.java: 示例程序
│  │      libICTCLAS30.so: ICTCLAS3.0 Library
│  │
│  └─Win_C:Windows下采用C的API
│          Example.cpp: 示例程序
│          Example.exe：示例程序生成的可执行文件
│          ICTCLAS30.dll：ICTCLAS3.0动态链接库
│          ICTCLAS30.h: ICTCLAS3.0头文件
│          ICTCLAS30.lib: ICTCLAS3.0 Library
│
├─Data:ICTCLAS3.0的数据文件
│      BiWord.big
│      charset.type
│      CoreDict.pdat
│      CoreDict.pos
│      CoreDict.unig
│      ICTCLAS.map
│      ICTCLAS30.ctx
│      ICTPOS.map
│      nr.ctx
│      nr.fsa
│      nr.role
│
├─docs：文档集合，用户手册需要
│      ICTPOS3.0.doc：ICTCLAS采用的词性标注集的含义解释
│
├─gif：图片，用户手册需要
│
└─Licenses：授权相关的文件夹
        LicenseClient.exe：Windows环境下的用户注册程序
        licenseClient_Linux：Linux环境下的用户注册程序
        user.lic             用户License文件，表明用户身份，必不可少，不得更改。
