## Two multipliers

`f[i]` is the number of decodings of the first `i` characters, with `f[0] = 1`:

`f[i] = one(s[i−1]) · f[i−1] + two(s[i−2], s[i−1]) · f[i−2]`, modulo `1e9 + 7`.

**One character:** `*` → 9 (digits 1–9); `0` → 0; any other digit → 1.

**Two characters `(a, b)`:**

| a | b | ways |
|---|---|------|
| `*` | `*` | 15 (11–19 and 21–26) |
| `*` | digit `d` | 2 if `d ≤ 6` (1d, 2d), else 1 |
| `1` | `*` | 9 |
| `2` | `*` | 6 |
| other digit | `*` | 0 |
| digit | digit | 1 if `10 ≤ ab ≤ 26`, else 0 |

Two rolling variables are enough.

Do not let `*` stand for 0; it means 1 to 9. Do not forget the modulus on every step; the counts grow like 9ⁿ.

Time: O(n)  
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
