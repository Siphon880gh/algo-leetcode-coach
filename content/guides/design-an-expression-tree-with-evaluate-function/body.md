Given the postfix tokens of an arithmetic expression (integers and the operators +, −, *, /), build an expression tree whose nodes expose an evaluate method, with division and other details as the statement specifies. For instance, ["3","4","+","2","*"] builds (3 + 4) * 2, which evaluates to 14. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Stack build, polymorphic evaluate

1. For each token: number → push `Leaf(v)`; operator → `r = pop()`, `l = pop()`, push `Op(token, l, r)`.
2. `Leaf.evaluate()` returns its value; `Op.evaluate()` applies its operator to the children's values.
3. The last node on the stack is the root.

Constructed check: `["3","4","+","2","*"]` → 14. `["4","5","2","7","+","-","*"]` → 4 · (5 − 9) = −16.

For the extensibility follow-up, map operator symbols to functions so new operators need no change to `Op`. Do not pop left before right.

Time: O(n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
