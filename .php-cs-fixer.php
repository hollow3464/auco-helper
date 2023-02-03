<?php 

$finder = PhpCsFixer\Finder::create()
->exclude(['vendor', '.idea'])
->in(__DIR__);

return (new PhpCsFixer\Config())->setFinder($finder)->setRules([
    '@PER'              => true,
    'array_syntax'      => true,
    'array_indentation' => true,

    'return_assignment' => true,
    'no_useless_return' => true,

    'standardize_not_equals'          => true,
    'space_after_semicolon'           => ['remove_in_empty_for_expressions' => true],
    'whitespace_after_comma_in_array' => ['ensure_single_space' => true],
    'trim_array_spaces'               => true,
    'echo_tag_syntax'                 => ['format' => 'short'],

    'method_argument_space'       => ['on_multiline' => 'ignore'],
    'method_chaining_indentation' => true,

    'no_multiline_whitespace_around_double_arrow' => true,
    'no_whitespace_before_comma_in_array'         => true,
    'no_alias_language_construct_call'            => true,
    'no_extra_blank_lines'                        => true,
    'no_spaces_around_offset'                     => true,
    'no_useless_concat_operator'                  => true,
    'no_empty_statement'                          => true,
    'no_singleline_whitespace_before_semicolons'  => true,

    'list_syntax'                              => true,
    'assign_null_coalescing_to_coalesce_equal' => true,
    'ternary_to_null_coalescing'               => true,
    'combine_consecutive_issets'               => true,
    'combine_consecutive_unsets'               => true,
    'explicit_indirect_variable'               => true,

    'concat_space'          => ['spacing' => 'one'],
    'unary_operator_spaces' => true,

    'binary_operator_spaces' => [
        'operators' => [
            '='  => 'align_single_space_minimal',
            '=>' => 'align_single_space_minimal',
        ]
    ],

    'method_argument_space' => [
        'on_multiline'                     => 'ensure_fully_multiline',
        'keep_multiple_spaces_after_comma' => false
    ],

    'single_space_after_construct' => [
        'constructs' => [
            'abstract', 'as', 'attribute', 'break',
            'case', 'catch', 'class', 'clone', 'comment',
            'const', 'const_import', 'continue', 'do',
            'echo', 'else', 'elseif', 'enum', 'extends',
            'final', 'finally', 'for', 'foreach', 'function',
            'function_import', 'global', 'goto', 'if',
            'implements', 'include', 'include_once',
            'instanceof', 'insteadof', 'interface',
            'match', 'named_argument', 'namespace',
            'new', 'open_tag_with_echo', 'php_doc',
            'php_open', 'print', 'private', 'protected',
            'public', 'readonly', 'require', 'require_once',
            'return', 'static', 'switch', 'throw', 'trait',
            'try', 'type_colon', 'use', 'use_lambda', 'use_trait',
            'var', 'while', 'yield', 'yield_from'
        ]
    ]
]);