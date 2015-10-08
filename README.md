# Phpunit VW Extension  
[![Build Status](https://travis-ci.org/hmlb/phpunit-vw.svg)](https://travis-ci.org/hmlb/phpunit-vw)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/hmlb/phpunit-vw/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/hmlb/phpunit-vw/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/199bb078-9e37-4b6f-8503-78125e0cb103/mini.png)](https://insight.sensiolabs.com/projects/199bb078-9e37-4b6f-8503-78125e0cb103)
[![AppVeyor](https://ci.appveyor.com/api/projects/status/io5mwpixtjss8bk8?svg=true)](https://ci.appveyor.com/project/hmlb/phpunit-vw)

VW makes failing test cases succeed in continuous integration tools.

Your primary objective is to ship more code to the world. No need to be slowed down by regressions or new bugs that happen during development.

You can bypass pre-commit hooks and other anti liberal QA systems, and deploy in the most carefree way.

* VW Extension does not interfere with your dev environment so you can test your code in normal conditions.  
* It automatically detects CI environments and makes your test suites succeed even with failing assertions or unwanted exceptions \o/

## Example

Here are the results of running the [VWTest case](src/Tests/VWTest.php) in different environments:   

```php
class VWTest extends PHPUnit_Framework_TestCase
{
    private $emissions = 12000;

    private $legalLimit = 300;

    public function testEnvironmentalImpactCompliance()
    {
        $this->assertLessThan($this->legalLimit, $this->emissions);
    }
}
```

Running in development environment:  
![Failing VWTest in dev environment](http://i.imgur.com/HYitIFn.png)

Running in CI environment: [![Build Status](https://travis-ci.org/hmlb/phpunit-vw.svg)](https://travis-ci.org/hmlb/phpunit-vw)  

![Succeeded VWTest in CI environment](http://i.imgur.com/jSw6pTq.png)  

## Installation

You can install VW Extension via [Composer](http://getcomposer.org)

    composer require hmlb/phpunit-vw:dev-master


## Usage

Just enable it by adding the following to your test suite's `phpunit.xml` file:

```xml
<phpunit bootstrap="vendor/autoload.php">
    ...
    <listeners>
        <listener class="HMLB\PHPUnit\Listener\VWListener" />
    </listeners>
</phpunit>
```

Now run your test suite as normal.

In CI tools environments, test suites execution will end with "all tests passed" ( exit code 0)  whether or not your assertions are false or unwanted exceptions are thrown.

## Configuration

Under the hood (wink wink), the "SecretSoftware" class detects if the phpunit process has been invoked in a CI tools environment. (Actually checks for the most used tools' default environment variables).

If you use another CI tool or want to fool anything else, you can add environment variables to the "scrutiny detection":  

**additionalEnvVariables** - Array of additional environment variables to switch the obfuscation on.

Add this in `phpunit.xml` when configuring the listener:

```xml
<phpunit bootstrap="vendor/autoload.php">
    ...
    <listeners>
        <listener class="HMLB\PHPUnit\Listener\VWListener" />
            <arguments>
                <array>
                    <element key="additionalEnvVariables">
                        <array>
                            <element>
                                <string>"FOO_CI"</string>
                            </element>
                            <element>
                                <string>"GOVERNMENT_TEST_TOOL"</string>
                            </element>
                        </array>
                    </element>
                </array>
            </arguments>
        </listener>
    </listeners>
</phpunit>
```

## Scandal

Any similarities with a current event concerning (but not limited to) a multinational automobile manufacturer are purely coincidental.

## CI tools detection

Currently detects :  

* TravisCI
* Appveyor
* Bamboo
* Buildkite
* CircleCI
* CodeShip
* GitlabCI
* Go CD
* Hudson
* Jenkins
* PHPCI
* TeamCity

Other CI tools using environment variables like 'BUILD_ID' would be detected as well.


## License

phpunit-vw is available under the MIT License.
