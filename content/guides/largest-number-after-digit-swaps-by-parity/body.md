## Parity keeps positions fixed

1. `odd` = odd digits sorted descending; `even` = even digits sorted descending.
2. For each position, take the next digit from the list matching the original digit’s parity.

Examples → 3412, 87655. Checked against exploring every allowed swap on 200 random numbers.

Swaps generate every permutation within a parity class, and positions never change parity class. num ≤ 10^9, so there are at most 10 digits.

Time: O(d log d)  
Space: O(d)

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
