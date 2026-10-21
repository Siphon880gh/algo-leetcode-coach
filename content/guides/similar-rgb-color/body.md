Colors are written `"#RRGGBB"` in hex, and a shorthand color like `"#ABC"` means `"#AABBCC"`. The similarity of two colors is the negative sum of squared differences of their three channels. Given a color, return the most similar color that has a shorthand form. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One channel at a time

The score is a sum over channels, so each channel can be chosen on its own.

For a channel value `v` (0–255), the shorthand choices are `17 · q` for `q` in `0 … 15`. The closest is `q = round(v / 17)`, computed as `(v + 8) // 17`. Write `q` as a hex digit twice.

Example: `"#09f166"`: `0x09 = 9` → `q = 1` → `11`; `0xf1 = 241` → `q = 14` → `ee`; `0x66 = 102` → `q = 6` → `66`. Answer `"#11ee66"`.

Do not try all 16³ = 4096 shorthand colors; that works but ignores the independence. Do not round on hex digits separately; the channel must be rounded as a whole number.

Time: O(1)  
Space: O(1)

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
