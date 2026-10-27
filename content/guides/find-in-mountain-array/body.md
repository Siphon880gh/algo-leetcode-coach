## Peak, left, right

1. Peak: `lo = 0`, `hi = n − 1`; while `lo < hi`: `mid = (lo + hi) // 2`; if `get(mid) < get(mid + 1)`, `lo = mid + 1`, else `hi = mid`. The peak is `lo`.
2. Search `[0, peak]` (ascending) for `target`. If found, return that index; it is the smaller one.
3. Search `[peak + 1, n − 1]` (descending: move left when `get(mid) < target`). Return the index or −1.

Each search costs about `log₂ 10⁴ ≈ 14` steps; the peak search uses two calls per step, so the total stays under 100. Cache `get` results if you like.

Do not search the right side first; the smallest index must win. Do not scan linearly; the call limit forbids it.

Time: O(log n) calls  
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
