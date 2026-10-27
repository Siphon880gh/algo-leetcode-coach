## Replace keys

1. `d = dict(knowledge)`.
2. Scan: on `(`, find the matching `)`, look up the key, append `d.get(key, "?")`, jump past `)`.
3. Otherwise append the character.

Example 1 → `"bobistwoyearsold"`. Example 2 → `"hi?"`. Example 3 → `"yesyesyesaaa"`.

Build with a list and join once; repeated `str.replace` per key is slow and can hit text outside brackets.

Time: O(|s| + total knowledge length)  
Space: O(|s| + knowledge)

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
