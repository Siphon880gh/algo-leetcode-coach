## Greedy line filling

`lines = 1`, `width = 0`. For each `c` with `w = widths[ord(c) − ord('a')]`:

- If `width + w > 100`: `lines += 1`, `width = w`.
- Else: `width += w`.

Return `[lines, width]`.

A letter is never split across lines, and every letter is at most 10 pixels, so it always fits on a fresh line.

Do not start with `lines = 0`; the first letter is already on line 1. Do not use `≥ 100`; a line may be exactly 100 pixels wide.

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
