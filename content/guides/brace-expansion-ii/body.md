## Two operators, one recursive parser

`parse(i)` reads an expression until `}` or the end and returns `(set, next index)`:

- `result = set()` (union so far), `term = {""}` (product so far).
- Letter: `term = {t + letter for t in term}`.
- `{`: `(inner, i) = parse(i + 1)`, skip the `}`, then `term = {t + w for t in term for w in inner}`.
- `,`: `result |= term`; `term = {""}`.
- On `}` or end: return `result | term`.

Answer: `sorted(parse(0))`.

Sets remove duplicates such as `"a"` from `"{a,{a}}"`.

Do not treat it like Brace Expansion I; groups nest here and commas can appear at any depth. Do not build lists and deduplicate only at the end; sets keep the intermediate products small.

Time: O(output size · length) in practice  
Space: O(output size)

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
