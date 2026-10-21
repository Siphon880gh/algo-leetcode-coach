## Split, count parts, check each part

**IPv4.** Split on `.`. There must be exactly 4 parts. Each part: 1 to 3 characters, all decimal digits, no leading zero unless the part is exactly `"0"`, value at most 255. `"192.168.01.1"` and `"192.168.1.00"` fail on leading zeros.

**IPv6.** Split on `:`. There must be exactly 8 parts. Each part: 1 to 4 characters, each in `0-9`, `a-f`, `A-F`. Leading zeros are fine (`"0000"`). The `::` shorthand is not allowed here — it makes an empty part, which fails the length check. `"02001:…"` fails because the part has 5 characters.

Choose which check to run by whether the string contains `.` or `:`. A split that keeps empty strings (so `"1.1.1.1."` has 5 parts) catches a trailing separator — some languages drop trailing empties, so check for that.

Do not use a language's `int()` alone — it may accept signs, spaces, or leading zeros. Do not allow `::` compression. Do not forget empty parts from `"1..1.1"`.

Time: O(n)  
Space: O(n) for the split

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
