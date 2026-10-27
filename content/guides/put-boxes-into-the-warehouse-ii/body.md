Boxes are pushed into a row of rooms from either the left or the right end; a box stops before a lower room, and boxes cannot be stacked. Return the maximum number of boxes placed. For instance, boxes `[1,2,2,3,4]` with rooms `[3,4,1,2]` → 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Best of both entrances

1. `left[i] = min(rooms[0..i])`, `right[i] = min(rooms[i..])`, `eff[i] = max(left[i], right[i])`.
2. Sort `eff` and boxes ascending; two pointers: if `box ≤ eff`, place and advance both, else advance the room.

Boxes `[1,2,2,3,4]`, rooms `[3,4,1,2]`: eff `[3,3,1,2]` → 4 boxes.

Do not fill from one side only. Because rooms closer to an end are entered first, placing larger boxes in rooms nearer the entrances is always consistent with the effective heights.

Time: O(n log n + m log m)  
Space: O(m)

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
