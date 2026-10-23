## Tiny example

Text `"hi👍"`.

- Unicode assigns code points (👍 is U+1F44D)
- UTF-8 stores ASCII `h`,`i` as 1 byte each, and 👍 as **4** bytes
- `len` in bytes ≠ number of user-perceived characters

ASCII is only 0–127; everything else needs Unicode + an encoding (UTF-8 common on the wire).


## How

1. Separate code point from encoded bytes
2. Use UTF-8 unless a platform forces UTF-16
3. For algorithms on “characters”, define whether you mean bytes, code points, or graphemes


## Trap

Cutting a UTF-8 string at an arbitrary byte index — you may split a multi-byte character.

**Fix:** Index by well-defined units (codepoints/runes) or validated boundaries.

**Space:** UTF-8 uses 1–4 bytes per code point

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
