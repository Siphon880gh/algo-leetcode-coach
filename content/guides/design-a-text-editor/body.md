## Left stack, right stack

1. `addText(t)`: push every character of `t` onto `L`.
2. `deleteText(k)`: pop `min(k, |L|)` characters from `L`; return that count.
3. `cursorLeft(k)`: move `min(k, |L|)` characters from `L` to `R`; `cursorRight(k)`: move `min(k, |R|)` from `R` to `L`. Both return the last `min(10, |L|)` characters of `L`.

Example → null, null, 4, null, etpractice, leet, 4, empty, practi.

Every operation touches only k or |text| characters, which is the O(k) follow-up; rebuilding a whole string on each call would not be. The right stack holds characters in reverse, so moving right pops them back in order.

Time: O(k) per call  
Space: O(total text)

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
