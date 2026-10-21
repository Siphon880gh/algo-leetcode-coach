## Smallest value, by sign

1. `num ≤ 0`: sort the digits of `|num|` descending and return the negative of that (0 stays 0).
2. `num > 0`: sort ascending; if the first digit is 0, swap in the first non-zero digit.

Examples → 103, −7650.

A negative value is smallest when its magnitude is largest, and leading zeros are not a concern there because descending order puts zeros last.

Time: O(d log d), d ≤ 16 digits  
Space: O(d)

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
