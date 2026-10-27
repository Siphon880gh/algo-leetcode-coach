Write each digit of n as its English word (4 → four), join the words in order, and return how many distinct letters appear an odd number of times in that string. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count

1. s = the words for the digits of n, joined.
2. Answer the number of letters with an odd count in s.

Constructed checks (run in code): n = 7 → 3 (s, v, n); n = 11 → 0; n = 208 → 6.

Counting distinct letters instead of odd ones: n = 11 → 3 instead of 0.

Time: O(digits)  
Space: O(26)

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
