Each polynomial is a linked list of (coefficient, power) nodes in strictly decreasing power with no zero coefficients. Return their sum in the same form, dropping terms that cancel. For instance, [[5,3],[4,1],[-1,0]] + [[2,2],[-4,1]] → [[5,3],[2,2],[-1,0]]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sorted merge

1. Dummy head; pointers `p`, `q`.
2. Higher power → append that node and advance it.
3. Equal power → `c = p.coef + q.coef`; append `(c, power)` only if `c ≠ 0`; advance both.
4. Append the remaining tail.

Constructed check: `[[5,3],[4,1],[-1,0]]` + `[[2,2],[-4,1]]` → `[[5,3],[2,2],[-1,0]]`. `[[1,1]]` + `[[-1,1]]` → empty.

Do not keep zero-coefficient nodes. Do not merge by increasing power; the lists run high to low.

Time: O(m + n)  
Space: O(1) extra

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
