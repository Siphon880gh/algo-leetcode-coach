## Peek two ahead

1. `i = 0`.
2. If `i + 2 < n` and `s[i + 2] == '#'`: append `chr(96 + int(s[i : i + 2]))`, `i += 3`.
3. Else append `chr(96 + int(s[i]))`, `i += 1`.

`"10#11#12"` → `"jkab"`. `"1326#"` → `"acz"`.

Do not decode one digit at a time without peeking; `"10#"` is j, not a then something. Scanning from the right also works: `#` means take the two digits before it.

Time: O(n)  
Space: O(n)

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
