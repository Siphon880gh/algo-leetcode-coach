## At most two copies matter

1. `kad(a)`: best subarray sum with empty allowed (`cur = max(0, cur + x)`).
2. If `k == 1`: return `kad(arr) mod M`.
3. `best = kad(arr + arr)`; if `sum(arr) > 0`, `best += (k − 2) · sum(arr)`.
4. Return `best mod (10⁹ + 7)`.

A best subarray spanning many copies is a suffix of one copy, whole middle copies, and a prefix of another; the middle helps only when the total is positive.

`[1,2]`, k = 3 → 9. `[1,−2,1]`, k = 5 → 2. `[−1,−2]`, k = 7 → 0.

Do not build all k copies; that is 10¹⁰ elements. Do not reduce mod before comparing sums; take the mod only at the end.

Time: O(n)  
Space: O(1) (iterate twice instead of copying)

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
