## Overlaps of overlaps

For `book(s, e)`:

1. If `[s, e)` overlaps any interval in `doubles`, a third booking would happen: return false.
2. For each `[a, b)` in `booked` that overlaps, add `[max(s, a), min(e, b))` to `doubles`.
3. Add `[s, e)` to `booked` and return true.

Overlap of half-open intervals: `s < b and a < e`.

**Sweep-line alternative:** a sorted map `delta`. Tentatively do `delta[s] += 1`, `delta[e] −= 1`, then walk the map keeping a running sum; if it reaches 3, undo the change and return false. This generalizes to any `k` (problem 732).

Do not merge the `doubles` intervals; they may overlap each other, and that is harmless. Do not add the overlaps before the triple check passes, or a rejected booking leaves traces.

Time: O(n) per booking  
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
