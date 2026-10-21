## Monotone feasibility

1. `ok(k)`: mark `removable[:k]`; two-pointer scan of `s` skipping marked indices; true if all of `p` is matched.
2. Largest `k` in `[0, len(removable)]` with `ok(k)`, using an upper mid.

`"abcacb", "ab", [3,1,0]` → 2. `"abcbddddd", "abcd", [3,2,1,4,5,6]` → 1. `"abcab", "abc", [0,1,2,3,4]` → 0.

Instead of re-marking each time, store each index's removal order and treat index `i` as removed when `order[i] < k`. `k = 0` is always feasible since `p` is a subsequence of `s`.

Time: O(n log r)  
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
