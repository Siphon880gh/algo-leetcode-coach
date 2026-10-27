## Test a target greedily

1. Prefix sums give each city’s current power.
2. `ok(t)`: sweep `i`; `cur` = stations added so far that still reach `i` (via a difference array). If `power[i] + cur < t`, add the shortfall at `min(i + r, n − 1)`, counting toward `k`.
3. Binary search the largest `t` in `[0, Σ stations + k]` with `ok(t)`.

Examples → 5, 4. Checked against trying every placement on 300 random small cases.

Every earlier city is already covered, so placing as far right as possible helps the most later cities. Powers reach about 10^10 and k up to 10^9, so use 64-bit.

Time: O(n log(Σ stations + k))  
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
