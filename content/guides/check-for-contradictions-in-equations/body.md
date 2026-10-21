You are given a list of equations, each a pair of variable names [A, B], and a list of values, where equations[i] with values[i] states that A / B = values[i]. Return true if the equations contradict each other and false otherwise. Two computed ratios count as equal when they differ by less than a small tolerance that the statement gives. For instance, a / b = 3, b / c = 0.5, a / c = 1.5 → false; le / et = 2, le / code = 5, code / et = 0.5 → true. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Ratios to the root

1. `w[x]` = value of `x / root(x)`; `find` compresses paths and multiplies weights along the way.
2. For `A / B = v`: `ra, rb` = roots. If `ra = rb`: contradiction if `|w[A] / w[B] − v|` is at least the tolerance. Else `parent[ra] = rb`, `w[ra] = v · w[B] / w[A]`.
3. Return false if no contradiction appears.

Constructed checks: the cases above → false, true (2 / 5 = 0.4, not 0.5).

Merging sets the weight so that `A / B = (w[A] · w[ra]) / w[B] = v`. Floating error builds up along chains, which is why the comparison uses a tolerance and never exact equality.

Time: O(n α(n))  
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
