You get a lowercase string that may contain the English words for digits, zero to nine, run together. Read it left to right: when a digit word starts at the current position, write its digit and jump past the word; otherwise skip one character. Return the digits written, or an empty string if none. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Scan

1. i = 0; out = "".
2. If one of "zero" … "nine" starts at i, append its digit and i += its length; else i += 1.
3. Return out.

Constructed checks (made-up values, run in code): "twoxnine" → "29"; "eightwo" → "8"; "sixsevn" → "6".

Collecting every word occurrence, overlaps included: "eightwo" → "82" instead of "8".

Time: O(n), checking 10 words of at most 5 letters at each position  
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
