## Difference DP

1. `f(n) = 0`.
2. For `i` from `n − 1` down: `f(i) = max over k = 1..3` of `Σ v[i..i + k − 1] − f(i + k)`.
3. `f(0) > 0` → Alice, `< 0` → Bob, else Tie.

`[1,2,3,7]` → Bob. `[1,2,3,-9]` → Alice. `[1,2,3,6]` → Tie.

Do not assume taking more stones is better; values can be negative. Do not track both players' scores separately; the difference is enough.

Time: O(n)  
Space: O(n), or O(1) with a rolling window

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
