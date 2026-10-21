## State: the other finger

1. Letter `c` sits at `(c / 6, c mod 6)`; distance is Manhattan; an unplaced finger moves for free.
2. `f(i, other)`: cost to type `word[i:]` with one finger on `word[i − 1]` and the other at `other`.
3. `f(i, other) = min(d(word[i − 1], word[i]) + f(i + 1, other), d(other, word[i]) + f(i + 1, word[i − 1]))`.
4. Answer `f(1, unplaced)`.

`"CAKE"` → 3. `"HAPPY"` → 6.

Do not track both fingers when one is implied; that adds a factor of 27. Do not charge for a finger's first placement.

Time: O(n · 27)  
Space: O(n · 27), or O(27) rolling

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
