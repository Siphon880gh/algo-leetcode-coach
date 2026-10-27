## Emit the longest ready run

1. `vals = [None] · (n + 1)`, `ptr = 1`.
2. `insert(id, v)`: `vals[id] = v`.
3. While `ptr ≤ n` and `vals[ptr]` is set: collect it, `ptr += 1`. Return the collected list.

Example (n = 5): insert 3 → `[]`; 1 → `["aaaaa"]`; 2 → `["bbbbb","ccccc"]`; 5 → `[]`; 4 → `["ddddd","eeeee"]`.

Each id is emitted once, so the total work over all calls is O(n). Do not return values after a gap.

Time: O(1) amortised per insert  
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
