## Sieve-style unions

1. DSU over `1 .. n`.
2. For `z` in `threshold + 1 .. n`: for `m = 2z, 3z, … ≤ n`: `union(z, m)`.
3. Query `(a, b)` → `find(a) == find(b)`.

`n = 6, t = 2`: `[[1,4],[2,5],[3,6]]` → `[false,false,true]`. `t = 0` → all true (1 divides everything). `n = 5, t = 1` → all false.

The unions cost `Σ n / z = O(n log n)`. Do not test gcd for every query pair against every divisor.

Time: O(n log n · α(n) + q · α(n))  
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
