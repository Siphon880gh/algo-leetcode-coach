## Tiny example

Take the text `"hi👍"`.

- Unicode gives every character a number called a code point. 👍 is U+1F44D.
- UTF-8 stores the ASCII letters `h` and `i` in 1 byte each, and 👍 in **4** bytes.
- So the length in bytes (6) is not the number of characters a person sees (3).

ASCII only covers the values 0 to 127. Everything else needs Unicode plus an encoding. UTF-8 is the common one for files and networks.

## How

1. Keep the code point separate from the bytes that encode it.
2. Use UTF-8 unless the platform forces UTF-16.
3. When an algorithm talks about "characters", decide whether you mean bytes, code points or the symbols a user sees.

## Trap

Cutting a UTF-8 string at an arbitrary byte index. You may split a character that takes several bytes.

**Fix:** Index by whole code points, or only cut at positions you know are character boundaries.

**Space:** UTF-8 uses 1 to 4 bytes per code point

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
