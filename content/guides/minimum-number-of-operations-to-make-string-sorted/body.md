## Multiset permutation rank

1. Precompute `fact` and `invFact` up to n.
2. For position `i` with letter `c` and `rest = n − i − 1` letters after it:
   for each letter `d < c` still available: add `rest! / Π count!` with `d` removed.
3. Remove `c` from the counts and continue.

`"cba"` → 5. `"aabaa"` → 2.

Recognising the steps as "previous permutation" is the key; simulating them can take astronomically many steps. Use modular inverses rather than division.

Time: O(26 · 26 · n) or O(26 · n) with a running product  
Space: O(n)

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
