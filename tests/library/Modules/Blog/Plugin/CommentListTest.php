<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category Gc_Tests
 * @package  Modules
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Modules\Blog\Plugin;

use Modules\Blog\Bootstrap;
use Gc\Document\Model as DocumentModel;
use Gc\DocumentType\Model as DocumentTypeModel;
use Gc\Layout\Model as LayoutModel;
use Gc\Module\Model as ModuleModel;
use Gc\User\Model as UserModel;
use Gc\View\Model as ViewModel;
use Gc\Registry;
use Zend\InputFilter\Factory as InputFilterFactory;
use Zend\View\Renderer\PhpRenderer;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-02-28 at 20:50:42.
 *
 * @group Modules
 * @category Gc_Tests
 * @package  Modules
 */
class CommentListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CommentList
     */
    protected $object;

    /**
     * @var ModuleModel
     */
    protected $module;

    /**
     * @var PhpRenderer
     */
    protected $renderer;

    /**
     * @var DocumentModel
     */
    protected $document;

    /**
     * @var ViewModel
     */
    protected $view;

    /**
     * @var LayoutModel
     */
    protected $layout;

    /**
     * @var UserModel
     */
    protected $user;

    /**
     * @var DocumentTypeModel
     */
    protected $documentType;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->view = ViewModel::fromArray(
            array(
                'name' => 'View Name',
                'identifier' => 'View identifier',
                'description' => 'View Description',
                'content' => 'View Content'
            )
        );
        $this->view->save();

        $this->layout = LayoutModel::fromArray(
            array(
                'name' => 'Layout Name',
                'identifier' => 'Layout identifier',
                'description' => 'Layout Description',
                'content' => 'Layout Content'
            )
        );
        $this->layout->save();

        $this->user = UserModel::fromArray(
            array(
                'lastname' => 'User test',
                'firstname' => 'User test',
                'email' => 'pierre.rambaud86@gmail.com',
                'login' => 'test',
                'user_acl_role_id' => 1,
            )
        );

        $this->user->setPassword('test');
        $this->user->save();

        $this->documentType = DocumentTypeModel::fromArray(
            array(
                'name' => 'Document Type Name',
                'description' => 'Document Type description',
                'icon_id' => 1,
                'defaultview_id' => $this->view->getId(),
                'user_id' => $this->user->getId(),
            )
        );

        $this->documentType->save();

        $this->document = DocumentModel::fromArray(
            array(
                'name' => 'Document name',
                'url_key' => 'url-key',
                'status' => DocumentModel::STATUS_ENABLE,
                'show_in_nav' => true,
                'user_id' => $this->user->getId(),
                'document_type_id' => $this->documentType->getId(),
                'view_id' => $this->view->getId(),
                'layout_id' => $this->layout->getId(),
                'parent_id' => null
            )
        );

        $this->document->save();

        $this->renderer = new PhpRenderer();
        $renderer       = Registry::get('Application')->getServiceManager()->get('Zend\View\Renderer\PhpRenderer');
        $this->renderer->setHelperPluginManager(clone $renderer->getHelperPluginManager());

        $this->renderer->layout()->currentDocument = DocumentModel::fromArray(
            array(
                'id' => $this->document->getId(),
            )
        );

        $this->module = ModuleModel::fromArray(
            array(
                'name' => 'Blog',
            )
        );
        $this->module->save();


        $this->boostrap = new Bootstrap();
        $this->boostrap->install();

        $this->object = new CommentList;
        $this->object->plugin('layout')->setController(
            $this->getMockForAbstractClass('\Zend\Mvc\Controller\AbstractController')
        );
        $this->object->layout()->currentDocument = $this->renderer->layout()->currentDocument;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        $this->boostrap->uninstall();
        $this->document->delete();
        $this->view->delete();
        $this->layout->delete();
        $this->documentType->delete();
        $this->user->delete();
        $this->module->delete();
        unset($this->module);
        unset($this->document);
        unset($this->view);
        unset($this->layout);
        unset($this->documentType);
        unset($this->user);
        unset($this->object);
        unset($this->renderer);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testInit()
    {
    }

    /**
     * Test
     *
     * @return void
     */
    public function testInvoke()
    {
        $this->assertInternalType('string', $this->object->__invoke());
    }
}
