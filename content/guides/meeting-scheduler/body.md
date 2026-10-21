Given two people's free time slots (each list without overlaps) and a meeting `duration`, return the earliest slot `[start, start + duration]` that fits in both people's availability, or an empty list. For instance, `[[10,50],[60,120]]` and `[[0,15],[60,70]]` give `[60,68]` for duration 8 and `[]` for duration 12. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Intersect in order

1. Sort both lists. `i = j = 0`.
2. `s = max(a[i][0], b[j][0])`, `e = min(a[i][1], b[j][1])`.
3. If `e − s ≥ duration`, return `[s, s + duration]`.
4. Advance the pointer whose slot ends first; repeat.
5. Return `[]`.

The slot that ends first cannot overlap anything later in the other list beyond what was checked.

A heap over both lists also works: pop the two earliest slots and compare neighbours from different people.

Do not skip sorting; slots may arrive unordered. Do not return the whole overlap; the answer has exactly `duration` length.

Time: O(n log n + m log m)  
Space: O(1) extra

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
