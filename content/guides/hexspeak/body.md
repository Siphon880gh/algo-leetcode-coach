Convert a decimal number (given as a string) to uppercase hexadecimal, replace 0 with O and 1 with I, and return the result if it uses only the letters A–F, I, and O; otherwise return `"ERROR"`. For instance, `"257"` (0x101) gives `"IOI"` and `"3"` gives `"ERROR"`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Convert and check

1. `h = hex(int(num))[2:].upper()`.
2. Replace `0` with `O` and `1` with `I`.
3. If any character is outside `{A, B, C, D, E, F, I, O}`, return `"ERROR"`; else return `h`.

Do not use lowercase hex; the letters must be uppercase. Do not parse the string into a 32-bit integer; the number can be large, so use arbitrary precision or 64-bit.

Time: O(log num)  
Space: O(log num)

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
