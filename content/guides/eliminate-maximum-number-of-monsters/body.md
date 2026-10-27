## Earliest first

1. `t[i] = ceil(dist[i] / speed[i])`; sort.
2. For `i = 0 …`: if `t[i] ≤ i`, return `i`.
3. Return `n`.

`[1,3,4], [1,1,1]` → 3. `[1,1,2,3], [1,1,1,1]` → 1. `[3,2,4], [5,3,2]` → 1.

Arrival at exactly minute `i` is a loss, hence `≤`. Integer ceiling `(d + s − 1) // s` avoids float issues; counting sort over arrival minutes capped at `n` gives O(n).

Time: O(n log n)  
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
