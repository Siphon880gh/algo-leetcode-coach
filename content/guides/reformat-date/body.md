## Token mapping

1. `d, m, y = date.split()`.
2. `day = int(d[:-2])`; `month = index of m in [Jan, …, Dec] + 1`.
3. Return `f"{y}-{month:02d}-{day:02d}"`.

`"20th Oct 2052"` → `"2052-10-20"`. `"6th Jun 1933"` → `"1933-06-06"`. `"26th May 1960"` → `"1960-05-26"`.

Do not strip only digits by position; days have one or two digits, so remove the last two characters instead. Do not forget zero-padding.

Time: O(1)  
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
