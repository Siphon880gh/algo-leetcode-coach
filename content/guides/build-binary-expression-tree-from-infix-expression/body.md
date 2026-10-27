Given an infix expression of single-digit operands, +, −, *, / and parentheses, build a binary expression tree whose in-order traversal reproduces the expression without parentheses and which evaluates in the usual order (precedence and left to right). For instance, 3*4-2*5 builds root − with children 3*4 and 2*5. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Shunting-yard into nodes

1. Digit → push a leaf onto `nodes`.
2. `(` → push to `ops`. `)` → combine until `(`, then pop it.
3. Operator `o` → while `ops` top is an operator with precedence ≥ `o`, combine; then push `o`.
4. At the end combine the rest; `nodes[0]` is the root.

`combine`: pop `op`, `right`, `left`; push `Node(op, left, right)`.

Constructed check: `3*4-2*5` → root `−`, left `3*4`, right `2*5`; value 2. `2-3-4` uses `≥` so it groups as `(2−3)−4` = −5.

Do not use `>` for equal precedence; that makes − and / right-associative.

Time: O(n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
