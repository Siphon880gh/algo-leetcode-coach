## Downhill only

1. `f(i) = 1 + max f(j)` over `j` scanned outward in each direction up to `d` steps, stopping at the first `arr[j] ≥ arr[i]`.
2. Memoize; heights strictly fall, so there are no cycles.
3. Return `max f(i)`.

`[6,4,14,6,8,13,9,7,10,6,12]`, d = 2 → 4. `[3,3,3,3,3]` → 1. `[7,6,5,4,3,2,1]`, d = 1 → 7.

Do not jump past a taller or equal bar; the scan stops there. Sorting indices by height and filling bottom-up also works.

Time: O(n · d)  
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
