Evaluate a string expression with non-negative integers, `+`, `-`, `*`, `/`, and parentheses. Division truncates toward zero, and the expression is always valid. Do not use a built-in eval. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Problem 227 plus parentheses

`calc(i)` evaluates from index `i` until a `)` or the end, returning the value and the next index:

- Keep `num = 0`, `op = '+'`, and a stack.
- Digits build `num`. A `(` calls `calc(i + 1)` and uses its result as `num`.
- At an operator, a `)`, or the end, apply the pending `op` to `num`:
  - `+`: push `num`. `−`: push `−num`.
  - `*`: replace the top with `top · num`. `/`: replace it with `top / num` truncated toward zero.
- Set `op` to the new operator and reset `num`. At `)` or the end, return `sum(stack)`.

Multiplication and division apply immediately to the top, which gives them higher precedence; the final sum handles `+` and `−`.

Truncate toward zero explicitly in languages where integer division floors (Python: `int(a / b)`).

Do not evaluate strictly left to right; `2+3*4` is 14. Do not forget that a parenthesized group acts as a single number for the surrounding operator.

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
