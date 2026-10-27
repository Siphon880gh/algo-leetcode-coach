Given a text, a screen width w and height h, a sorted array of font sizes and an interface that reports a character's width and the line height at a font size, return the largest font that fits the text on one line (total width ≤ w and height ≤ h), or −1. For instance, if font 6 needs width 48 with w = 40 but font 5 fits, the answer is 5. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Monotone check

1. `fits(f)`: `getHeight(f) ≤ h` and `Σ getWidth(f, ch) ≤ w` (stop early when it exceeds).
2. Binary search the font array for the last index where `fits` is true.
3. Return that font, or −1.

Constructed check: fonts `[3,4,5,6]`, font 6 too wide, 5 fits → 5. If even the smallest is too tall → −1.

Count each distinct character once per font with a frequency table to cut interface calls. Do not scan all fonts linearly when the list is long.

Time: O(log F · |text|)  
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
