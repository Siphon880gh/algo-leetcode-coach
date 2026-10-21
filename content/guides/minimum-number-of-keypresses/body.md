A keypad has 9 buttons. You map all 26 lowercase letters to the buttons, each letter to exactly one button and at most 3 letters per button. Typing a letter costs its position on its button: 1 press for the first, 2 for the second, 3 for the third. Given a string s, return the minimum total number of keypresses needed to type it with the best mapping. For instance, apple → 5; abcdefghijkl → 15. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Rank by frequency

1. Count each letter; sort counts descending.
2. Return `Σ count[i] · (i / 9 + 1)`.

Constructed checks: the cases above → 5, 15; aaaaaaaaab → 10.

Each button has one slot of each cost, so there are 9 one-press slots, 9 two-press slots and 8 three-press slots. Giving the cheapest slots to the most frequent letters is optimal by an exchange argument.

Time: O(n + 26 log 26)  
Space: O(26)

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
