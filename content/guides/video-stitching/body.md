## Furthest reach from each start

1. `far[s]` = max end of clips starting at `s` (for `s < time`).
2. `count = 0`, `end = 0`, `reach = 0`. For `t` from 0 to `time − 1`:
   - `reach = max(reach, far[t])`.
   - If `t == end`: if `reach ≤ t`, return −1; otherwise `count += 1`, `end = reach`.
3. Return `count`.

Each new clip is the one reaching furthest from the covered prefix, which is optimal.

Do not sort clips and pick by length; length alone ignores where the gap is. Do not loop past `time`; clips ending after it are fine but not needed.

Time: O(n + time)  
Space: O(time)

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
