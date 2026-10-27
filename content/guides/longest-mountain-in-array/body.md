## One pass from each base

`i = 0`. While `i < n`:

- `base = i`. Climb: while `i + 1 < n` and `arr[i] < arr[i + 1]`, `i += 1`. Call it `peak`.
- If the climb made progress, descend: while `i + 1 < n` and `arr[i] > arr[i + 1]`, `i += 1`.
- If both the climb and the descent made progress, `best = max(best, i − base + 1)`.
- If neither moved (a flat step), `i += 1`.

Each index is visited a constant number of times.

**Two arrays alternative:** `up[i]` = the length of the increasing run ending at `i`, `down[i]` = the decreasing run starting at `i`. A peak needs both positive; its length is `up[i] + down[i] + 1`.

Do not count a climb without a descent, or a descent without a climb. Do not treat equal neighbors as part of a slope.

Time: O(n)  
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
