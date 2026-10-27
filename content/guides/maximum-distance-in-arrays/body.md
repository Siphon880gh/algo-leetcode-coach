## Running min and max from other arrays

The two values must come from different arrays. Since each array is sorted, the best candidates are its first value (smallest) and last value (largest).

Set `mn = arrays[0][0]`, `mx = arrays[0][-1]`. For each later array `a`:

1. `ans = max(ans, a[-1] − mn, mx − a[0])`.
2. Then `mn = min(mn, a[0])`, `mx = max(mx, a[-1])`.

Comparing before updating guarantees the pair always uses two different arrays.

Do not take the global max minus the global min; both can come from the same array. Do not scan whole arrays; only the ends can be extremes.

Time: O(m) for m arrays  
Space: O(1)

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
