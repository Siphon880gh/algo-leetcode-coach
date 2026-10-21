## Divide, collect remainders, reverse

If `num` is 0, return `"0"`. Remember the sign and work on `|num|`. While it is positive, append `|num| % 7` as a digit and set `|num| //= 7`. The digits come out least significant first, so reverse them, then put `"-"` in front if the input was negative.

Doing the division on the absolute value avoids language differences in how `%` and `/` treat negative numbers.

Convert to Base −2 (1017) uses a negative base, where remainders need fixing. Convert a Number to Hexadecimal (405) uses two's complement for negatives. Excel Sheet Column Title (168) is base 26 with no zero digit.

Do not return an empty string for 0. Do not apply `%` to a negative number in languages where it returns a negative remainder.

Time: O(log₇ |num|)  
Space: O(log₇ |num|)

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
