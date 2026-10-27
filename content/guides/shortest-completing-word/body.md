## Counts, not just letters

1. `need[c]` = how many times lowercase letter `c` appears in the plate (lowercase everything; skip digits and spaces).
2. For each word in order, count its letters and check `word_count[c] ≥ need[c]` for every `c`.
3. Keep the first word with the smallest length that passes (update only on strictly shorter).

Repeated letters matter: plate `"1s3 PSt"` needs two `s` letters, so `"step"` fails and `"steps"` passes.

Do not compare letter sets; counts matter. Do not update on equal length; the earliest word must win.

Time: O(total word length)  
Space: O(1) (26 counters)

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
