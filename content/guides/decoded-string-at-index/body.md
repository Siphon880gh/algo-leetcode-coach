## Never build the tape

The decoded string can be 2⁶³ characters long.

1. Forward pass: `size = 0`; a letter adds 1, a digit `d` multiplies `size` by `d`.
2. Backward pass over `i` from the end:
   - `k %= size`.
   - If `k == 0` and `s[i]` is a letter, return `s[i]`.
   - If `s[i]` is a digit `d`, `size //= d`; else `size −= 1`.

Why it works: after a digit, the tape is several copies of the earlier tape, so position `k` is the same as `k mod size`. `k == 0` means the last character of the current tape, which is `s[i]` when it is a letter.

Do not expand the string. Do not convert `k` to 0-based; with the 1-based `k`, `k == 0` after the mod stands for the last position.

Time: O(n)  
Space: O(1)

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
